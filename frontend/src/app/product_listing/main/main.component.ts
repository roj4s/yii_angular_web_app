
import {Component, OnInit} from "@angular/core";
import {ApiService} from "../../api_service/api.service";
import {RandomImageModel} from "../../model/random_image.model";
import { ActivatedRoute } from '@angular/router';
import 'rxjs/add/operator/switchMap';
import {Router} from '@angular/router';


@Component({
    selector: 'product-listing-main',
    templateUrl: './main.template.html',
    styleUrls:['main.styles.scss']
})

export class ProductListingMainComponent implements OnInit{

    private department_id = 1;
    private department_name = "Unknown";
    private data:any[]= [];


    ngOnInit(): void {

        this.route.params.subscribe((params) =>
        {
            this.department_id = params.id_department;
            console.log("Got new department");
            console.log(params);
            console.log(this.department_id);

            this.api_service.getProducts(this.department_id)
                .subscribe(
                    (response)=>{
                        this.data  = response;
                        if(this.data.length > 0) {
                            this.department_name = this.data[0].department_name;
                            console.log(this.department_name);
                        }
                    }
                );




        });


    }

    public products:RandomImageModel[] = [];

    constructor(
        private api_service:ApiService,
        private route:ActivatedRoute,
        private router:Router
    ){


    }

    public delete_product(id)
    {
        console.log("Deleting product with id " + id);
        this.api_service.deleteProduct(id)
            .subscribe((
                next
            )=>{
               alert("Done");
            })
        ;

        /*
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then(function() {
            swal(
                'Deleted!',
                'Your imaginary file has been deleted.',
                'success'
            )
        }, function(dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        });*/
    }
}