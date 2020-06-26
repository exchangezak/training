<template>
<div>
     <h1>{{title}}</h1>
          <!--le composant l-map a des proprietes  zoom et centrer qu'on va rendre dynamiques en les liant 
          aux proprietes correspondantes  du state(zoom ,lat,lng)-->

     <l-map
     :zoom="zoom"
     :center="[lat,lng]"
        style="height:400px;width=70%;"

     >
        <l-tile-layer :url="url"/>
        <l-marker :lat-lng="[lat,lng]" title="test hover"> 
            <l-popup>
                <div>
                    <h3>ISS COORDINATES</h3>
                    <p>Latitude : {{lat}}</p>
                    <p>Longitude :{{lng}} </p>
                </div>
            </l-popup>
        </l-marker>
     </l-map>
</div>
   
</template>
<script>
import {LMap,LTileLayer,LMarker,LPopup} from "vue2-leaflet";
export default {
    name:"Map",
    props:{
        title:String
    },
    components:{
        LMap,
        LTileLayer,
        LMarker,
        LPopup,

    },
    data(){
        return{
            //la propiétéé url va contenir l'url du fond carte q'on va utilser
            url:'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            // ici on va configurer notre carte
            lat:"",
            lng:"",
            zoom:4,
            isLocated:false,
            location:{}
        };
    },
    methods: {
        getIssPosition: function(){
            fetch("http://api.open-notify.org/iss-now.json")
            .then(response => response.json()) // equivalent JSON.parse()
            .then(data =>
             {
                this.lng=data.iss_position.longitude
                this.lat=data.iss_position.latitude

            });
        },
        //une autre methode avec asynchronous
        // getIssPositionAsync: async function() {
        //     const response = await fetch("http://api.open-notify.org/iss-now.json");
        //     const json = await response.json();
        //     console.log(json);
        // }
    },
    created(){
        this.getIssPosition();
        setInterval(()=>{
            this.getIssPosition();
        },4000);
    }
};
</script>
<style scoped>

</style>