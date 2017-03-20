/**
 * Created by Mounir on 19/03/2017.
 */
import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';

//import { Group } from '../_models/index';
import {Observable} from 'rxjs/Rx';

// Import RxJs required methods
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

@Injectable()
export class GroupService {
    private groupUrl = 'http://localhost/app_dev.php/api/groups';

    constructor(private http: Http) {
    }

    public getAllGroups() {
        return this.http.get(this.groupUrl, this.check_auth())
            .map((response: Response) => response.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    private check_auth() {
        // create authorization header with oauth2 token
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
