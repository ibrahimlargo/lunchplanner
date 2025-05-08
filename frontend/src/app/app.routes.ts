import {Routes} from '@angular/router';
import {AppComponent} from './app.component';
import {KontaktComponent} from './kontakt/kontakt.component';

export const routes: Routes = [
  {path: '', component: AppComponent},
  {path: 'hello', component: KontaktComponent}
];
