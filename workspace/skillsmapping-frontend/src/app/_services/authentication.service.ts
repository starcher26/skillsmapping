import { Injectable } from '@angular/core';
import { Http, Headers, URLSearchParams, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'

@Injectable()
export class AuthenticationService {
    // Oauth Login EndPointUrl to web API
    private OauthLoginEndPointUrl = 'http://localhost/app_dev.php/oauth/v2/token';
    private clientId ='4_2hl92c84uhq8cw0w4gco0cw0k8k40s0cg8gcsogg4o8ggo8ogg';
    private clientSecret ='3rptysr1u5mogkwsk4owg8880ws00s4skso4wgccskkc0g0oc0';
    constructor(private http: Http) { }

    login(username: string, password: string) {
        let params: URLSearchParams = new URLSearchParams();
        params.set('username', username );
        params.set('password', password );
        params.set('client_id', this.clientId );
        params.set('client_secret', this.clientSecret );
        params.set('grant_type', 'password' );
        return this.http.get(this.OauthLoginEndPointUrl , {
            search: params
        }).map((response: Response) => {
            // login successful if there's a oauth token
            let user = response.json();
            if (user && user.access_token) {
                // store user details and oauth token in local storage to keep user logged in between page refreshes
                user.username = username;
                localStorage.setItem('currentUser', JSON.stringify(user));
            }
        });

    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
    }
}