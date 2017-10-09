
import {Component} from "@angular/core";
import {Product} from "../model/product.model";
import {ApiService} from "../api_service/api.service";

@Component({
    selector: 'create-new-product-form',
    templateUrl: './create-new-product-form.template.html'
})

export class CreateNewProductComponent{

    private product:Product;


    constructor(
        private api_service:ApiService
    ){

        this.product = new Product();

    }

    public send(){

        console.log(this.product);

        this.api_service.newProduct(this.product)
            .subscribe(
                (next)=>{
                    console.log(next);
                    alert("Done");
                }
            );


    }

}