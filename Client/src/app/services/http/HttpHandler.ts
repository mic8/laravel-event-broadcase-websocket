import { Observable } from 'rxjs/Observable';
import { Response } from '@angular/http';

export class HttpHandler {

    protected extractData(res: Response) {
        let body = res.json();
        return body.data || { };
    }

    protected handleError(error: Response | any) {
        let errMsg: string;
        if (error instanceof Response) {
            const body = error.json() || '';
            const err = body.error || JSON.stringify(body);
            errMsg = `${error.status} - ${error.statusText || ''} ${err}`;
        } else {
            errMsg = error.message ? error.message : error.toString();
        }
        console.error(errMsg);
        return Observable.throw(errMsg);
    }

}