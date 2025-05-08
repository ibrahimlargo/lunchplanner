<?php

namespace App\Http\Controllers;

use App\Models\Passkey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;
use Webauthn\AttestationStatement\AttestationStatementSupportManager;
use Webauthn\AuthenticatorAssertionResponse;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Webauthn\AuthenticatorAttestationResponse;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorSelectionCriteria;
use Webauthn\Denormalizer\WebauthnSerializerFactory;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\PublicKeyCredentialRpEntity;
use Webauthn\PublicKeyCredentialUserEntity;

class PasskeyController extends Controller
{
    public function registerOptions(Request $request)
    {
        $options = new PublicKeyCredentialCreationOptions(
            rp: new PublicKeyCredentialRpEntity(
                name: config('app.name'),
                id: parse_url(config('app.url'), PHP_URL_HOST),
            ),
            user: new PublicKeyCredentialUserEntity(
                name: $request->user()->email,
                id: $request->user()->id,
                displayName: $request->user()->name,
            ),
            challenge: Str::random(),
            authenticatorSelection: new AuthenticatorSelectionCriteria(
                authenticatorAttachment: AuthenticatorSelectionCriteria::AUTHENTICATOR_ATTACHMENT_CROSS_PLATFORM,
                residentKey: AuthenticatorSelectionCriteria::RESIDENT_KEY_REQUIREMENT_REQUIRED,
            ),
        );

        Session::flash('passkey-registration-options', $options);

        return $options;
    }

    public function authenticateOptions()
    {
        $options = new PublicKeyCredentialRequestOptions(
            challenge: Str::random(),
            rpId: parse_url(config('app.url'), PHP_URL_HOST),
        );

        Session::flash('passkey-authentication-options', $options);

        return $options;
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'answer' => 'required|json',
        ]);

        /** @var PublicKeyCredential $publicKeyCredential */
        $publicKeyCredential = (new WebauthnSerializerFactory(AttestationStatementSupportManager::create()))->create(
        )->deserialize(
            $data['answer'],
            PublicKeyCredential::class,
            'json',
        );

        if (! $publicKeyCredential->response instanceof AuthenticatorAssertionResponse) {
            return redirect()->route('profile.edit');
        }

        $passkey = Passkey::query()->firstWhere('credential_id', base64_encode($publicKeyCredential->rawId));

        if (! $passkey) {
            throw ValidationException::withMessages([
                'answer' => 'Passkey ist nicht valide!',
            ]);
        }

        try {
            $publicKeyCredentialSource = AuthenticatorAssertionResponseValidator::create()->check(
                credentialId: $passkey->data,
                authenticatorAssertionResponse: $publicKeyCredential->response,
                publicKeyCredentialRequestOptions: Session::get('passkey-authentication-options'),
                request: $request->getHost(),
                userHandle: null,
            );
        } catch (Throwable) {
            throw ValidationException::withMessages([
                'answer' => 'Passkey ist nicht valide!',
            ]);
        }

        $passkey->update(['update' => $publicKeyCredentialSource]);

        Auth::login($passkey->user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'passkey' => 'required|json',
            'name' => 'required|string|max:255',
        ]);

        /** @var PublicKeyCredential $publicKeyCredential */
        $publicKeyCredential = (new WebauthnSerializerFactory(AttestationStatementSupportManager::create()))->create(
        )->deserialize(
            $data['passkey'],
            PublicKeyCredential::class,
            'json',
        );

        if (! $publicKeyCredential->response instanceof AuthenticatorAttestationResponse) {
            return redirect()->route('login');
        }

        try {
            $validator = AuthenticatorAttestationResponseValidator::create();

            $publicKeyCredentialSource = $validator->check(
                authenticatorAttestationResponse: $publicKeyCredential->response,
                publicKeyCredentialCreationOptions: Session::get('passkey-registration-options'),
                request: $request->getHost(),
            );
        } catch (Throwable $e) {
            return back()->with('error', 'Passkey konnte nicht hinzugefügt werden!');
        }

        $request->user()->passkeys()->create([
            'name' => $data['name'],
            'data' => $publicKeyCredentialSource,
        ]);

        return back()->with('success', 'Passkey wurde erfolgreich hinzugefügt');
    }

    public function destroy(Request $request, Passkey $passkey)
    {
        $passkey->delete();

        return back()->with('success', 'Passkey wurde erfolgreich gelöscht');
    }
}
