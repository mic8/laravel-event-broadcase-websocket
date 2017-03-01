import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

import { HttpHandler } from '../http/HttpHandler';

import { UserModel } from '../../models/user/user.model';

@Injectable()
export class UserService extends HttpHandler {

    private url: string = 'http://localhost:8000/api/user';

    constructor(private http: Http) {
        super();
    }

    fetch(): Observable<UserModel[]> {
        return this.http.get(this.url)
            .map(this.extractData)
            .catch(this.handleError);
    }

}