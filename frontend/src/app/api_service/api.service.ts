import {Injectable} from "@angular/core";
import {Http, Headers} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {ConfigService} from "../config.service";
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';
import {Department} from "../model/department.model";
import {RandomImageModel} from "../model/random_image.model";
import {Product} from "../model/product.model";

@Injectable()
export class ApiService {


    constructor(
        private http: Http,
        private global_config_service: ConfigService
    ){
    }

    private getHeaders():Headers {
        return new Headers({
            'Content-Type': 'application/json',
            // 'Authorization': 'Bearer '+this._userService.getAccessToken(),
        });
    }

    public getDepartments(department_id=null):Observable<Department[]>{

            let headers = this.getHeaders();

            let url = this.global_config_service.api_host + "/departments";

            if(department_id)
                url += "/byid?id=" + department_id;

            return this.http.get(
                url,
                {
                    headers: headers
                }
            ).map(response => response.json())
                .map((response) => {
                    console.log(response);
                    return <Department[]>response;
                })
                .catch(this.handleError);
    }

    public getProducts(department_id = 1):Observable<any[]>{

            let headers = this.getHeaders();

            return this.http.get(
                this.global_config_service.api_host + "/products/filtered/by-department-sumary?department=" + department_id,
                {
                    headers: headers
                }
            ).map(response => response.json())
                .map((response) => {
                    console.log(response);
                    return <any[]>response;
                })
                .catch(this.handleError);
    }


    public newProduct(product:Product):Observable<any>{


            return this.http.post(
                this.global_config_service.api_host+"/products" ,
                product
            ).map((response)=>{return response.json();});


    }

    public deleteProduct(id):Observable<any>{


        return this.http.delete(
            this.global_config_service.api_host+"/products/" + id ,
        ).map((response)=>{return response.json();});

    }

    public serialize = function(obj, prefix) {
        var str = [], p;
        for(p in obj) {
            if (obj.hasOwnProperty(p)) {
                var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
                str.push((v !== null && typeof v === "object") ?
                    this.serialize(v, k) :
                    encodeURIComponent(k) + "=" + encodeURIComponent(v));
            }
        }
        return str.join("&");
    }

    public getRandomImages():Observable<RandomImageModel[]>{

            let headers = this.getHeaders();

            return this.http.get(
                this.global_config_service.api_host + "/products/random-images",
                {
                    headers: headers
                }
            ).map(response => response.json())
                .map((response) => {
                    console.log();
                    console.log(response);
                    return <RandomImageModel[]>response;
                })
                .catch(this.handleError);
    }

    private handleError (error: Response | any) {

        let errorMessage:any = {};
        // Connection error
        if(error.status == 0) {
            errorMessage = {
                success: false,
                status: 0,
                data: "Sorry, there was a connection error occurred. Please try again.",
            };
        }
        else {
            errorMessage = error.json();
        }
        return Observable.throw(errorMessage);
    }

}