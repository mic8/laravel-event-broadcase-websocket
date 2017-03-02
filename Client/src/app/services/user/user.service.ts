import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

import { HttpHandler } from '../http/HttpHandler';
import { ApiPrefix } from '../http/ApiPrefix';

import { UserModel } from '../../models/user/user.model';

@Injectable()
export class UserService extends HttpHandler {

    private url: string = ApiPrefix.prefix + '/user';

    constructor(private http: Http) {
        super();
    }

    fetch(): Observable<UserModel[]> {
        return this.http.get(this.url)
            .map(this.extractData)
            .catch(this.handleError);
    }

    store(params?: UserModel): Observable<UserModel> {
        return this.http.post(this.url, params)
            .map(this.extractData)
            .catch(this.handleError);
    }

    delete(params?: UserModel): Observable<any> {
        let id = params.id;

        return this.http.delete(this.url + '/' + id)
            .map(this.extractData)
            .catch(this.handleError);
    }

}