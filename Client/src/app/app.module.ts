import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';

import { requestOptionsProvider } from './app.default-request-options';

import { AppComponent } from './app.component';
import { PageNotFoundComponent } from './components/exceptions/page-not-found/page-not-found.component';

import { UserComponent } from './components/user/user.component';
import { PostComponent } from './components/post/post.component';

const routes: Routes = [
    {
        path: 'user',
        component: UserComponent
    },
    {
        path: 'post',
        component: PostComponent
    },
    {
        path: '',
        redirectTo: '/user',
        pathMatch: 'full'
    },
    {
        path: '**',
        component: PageNotFoundComponent
    }
];

@NgModule({
  declarations: [
      AppComponent,
      PageNotFoundComponent,
      UserComponent,
      PostComponent
  ],
  imports: [
      BrowserModule,
      FormsModule,
      ReactiveFormsModule,
      HttpModule,
      RouterModule.forRoot(routes)
  ],
  providers: [ requestOptionsProvider ],
  bootstrap: [ AppComponent ]
})
export class AppModule { }
