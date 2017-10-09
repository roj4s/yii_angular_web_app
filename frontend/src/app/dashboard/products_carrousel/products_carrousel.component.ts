import {Component, OnInit} from '@angular/core';
import {RandomImageModel} from "../../model/random_image.model";
import {ApiService} from "../../api_service/api.service";

import { ICarouselConfig, AnimationConfig } from 'angular4-carousel';

@Component({
    selector: 'products-carrousel',
    templateUrl: './products_carrousel.template.html',
    styleUrls: ['./products_carrousel.styles.scss']
})

export class ProductsCarrouselComponent
     implements OnInit
{


    public slides:RandomImageModel[] = [];
    public loading:boolean;
    public imageSources:string[] = [
        "https://i5.walmartimages.com/asr/04e88fb1-a65a-4e39-a549-a6b289ac36e3_1.835bbfc45c741655a99e75d433857bb7.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF",
        "https://i5.walmartimages.com/asr/6d45edfb-d51e-42a1-9539-728652dedbc8_1.2c7bdd728cf0213a0616515c03a94f49.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF",
        "https://i5.walmartimages.com/asr/bb128dc4-8267-43ec-9423-8ba5107f39a6_1.bb899497f1ec44b2029393014ec34fae.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF"

        ];


    public config: ICarouselConfig = {
        verifyBeforeLoad: true,
        log: false,
        animation: true,
        animationType: AnimationConfig.SLIDE,
        autoplay: true,
        autoplayDelay: 2000,
        stopAutoplayMinWidth: 768
    };

    constructor(
        private api_service:ApiService
    ){
    }


    ngOnInit(): void {

            this.loading = true;
        this.api_service.getRandomImages().subscribe(
            (response:RandomImageModel[])=>{

                this.imageSources =[];

                this.slides = response;
                console.log('slides');
                console.log(this.slides);

                this.slides.forEach((el:RandomImageModel)=>{
                   this.imageSources.push(el.large_url);

                });
                console.log(this.imageSources);

                this.loading = false;
        }
        );


    }

}