import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';

import { User } from '../_models/index';
import {Observable} from 'rxjs/Rx';

// Import RxJs required methods
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

@Injectable()
export class UserService {
    private userUrl = 'http://localhost/app_dev.php/api/users';
    constructor(private http: Http) { }

    public getAllUsers() {
        return this.http.get(this.userUrl, this.check_auth())
            .map((response: Response) => response.json())
            .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    public getUserById(id: number) {
        return this.http.get(this.userUrl + id, this.check_auth())
            .map((response: Response) => response.json())
            .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    public createUser(user: User) {

        return this.http.post(this.userUrl, JSON.stringify(user), this.check_auth())
            .map((res:Response) => res.json())
            .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    public updateUser(user: User) {
        return this.http.put(this.userUrl + user.id, JSON.stringify(user), this.check_auth())
            .map((response: Response) => response.json())
            .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    public deleteUser(id: number) {
        return this.http.delete(this.userUrl + '/' + id, this.check_auth())
            .map((response: Response) => response.json())
            .catch((error:any) => Observable.throw(error.json().error || 'Server error'));;
    }

    // private helper methods

    private check_auth() {
        // create authorization header with jwt token
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.access_token) {
            let headers = new Headers({
                'Authorization': 'Bearer ' + currentUser.access_token,
                'Content-Type': 'application/json;charset=UTF-8'
            });
            return new RequestOptions({ headers: headers });
        }
    }
}