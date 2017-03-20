import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';
import { HttpModule } from '@angular/http';

import { ImageUploadModule } from 'ng2-imageupload';
import { CollapseDirective } from 'ng2-bootstrap';
import { DropdownModule } from 'ng2-bootstrap';
import {SelectModule} from 'ng2-select';

import { AppComponent }  from './app.component';
import { routing }        from './app.routing';

import { AlertComponent } from './_directives/index';
import { AuthGuard } from './_guards/index';
import { AlertService, AuthenticationService, UserService, GroupService } from './_services/index';
import { HomeComponent } from './home/index';
import { LoginComponent } from './login/index';
import { RegisterComponent } from './register/index';
import { NavbarService } from './_services/index';
import { TopNavbarComponent } from './menu/topnavbar/index';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        ImageUploadModule,
        SelectModule,
        DropdownModule.forRoot(),
        routing
    ],
    declarations: [
        AppComponent,
        AlertComponent,
        TopNavbarComponent,
        CollapseDirective,
        HomeComponent,
        LoginComponent,
        RegisterComponent

    ],
    providers: [
        AuthGuard,
        AlertService,
        NavbarService,
        AuthenticationService,
        UserService,
        GroupService
    ],
    bootstrap: [AppComponent]
})

export class AppModule {
    public isCollapsed: boolean = false;
}