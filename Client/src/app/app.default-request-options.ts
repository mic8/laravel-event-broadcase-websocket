import { Injectable } from '@angular/core';
import { BaseRequestOptions, RequestOptions } from '@angular/http';

@Injectable()
export class AppDefaultRequestOptions extends BaseRequestOptions {

    constructor() {
        super();

        this.headers.set('Content-Type', 'application/json');
    }

}

export const requestOptionsProvider = { provide: RequestOptions, useClass: AppDefaultRequestOptions };