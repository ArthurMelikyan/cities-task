<template>
    <div>
        <div class="form-group">
            <input id="searchTextField" v-model="city_val" type="text" size="50">
            <button type="submit" class="btn btn-primary" @click="saveWeather">Save weather</button>
        </div>

        <div class="container mt-5 pt-5" v-show="weatherTable.length">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">City</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Temperature</th>
                        <th scope="col">Date/time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(city , key) in weatherTable" :key="key">
                        <td>{{city.name}}</td>
                        <td>{{city.full_name}}</td>
                        <td>{{city.temperature}}</td>
                        <td>{{city.time}}</td>
                    </tr>
                </tbody>
                </table>

        </div>
    </div>
</template>

<script>
    export default {
        props : {
            app_id : {}
        },
        data() {
            return {
                city_val : '',
                place_to_submit : {},
                weatherTable : [],
                temperature : '',
            }
        },
        methods:{
            saveWeather(){
                if (this.place_to_submit && this.place_to_submit.lat) {
                    if (this.temperature) {
                        axios.post(`/save-weather`, {
                                data :this.place_to_submit, temp : this.temperature
                            }).then(response => {
                                if (response.data && !response.data.errors) {
                                    this.place_to_submit = {};
                                    this.temperature = '';
                                    this.city_val = '';
                                    this.fetchCitiesDB();
                                    // alert(response.data.message)
                                }
                        }).catch((error) => {
                            alert('something wrong...')
                        });
                    }
                }
            },
            getTemperature(data){
                  axios.get(`/get-weather`, {params : this.place_to_submit }).then(response => {
                      if (response.data && !response.data.errors) {
                          this.temperature = response.data.temp;
                      }
                }).catch((error) => {
                    alert('something wrong')
                });
            },
            fetchGeoData(data){
                this.place_to_submit = {
                    fullName : data.formatted_address,
                    city : data.name,
                    placeId : data.place_id,
                    lat : data.geometry.location.lat(),
                    lng : data.geometry.location.lng()
                }
                this.getTemperature(this.place_to_submit);
            },
            fetchCitiesDB(){
                axios.get(`/fetch-cities`).then(response => {
                    if (response.data) {
                        this.weatherTable = response.data;
                    }
                }).catch((error) => {
                    alert('something wrong')
                });
            },
            saveInHistory(place_name){
                 axios.post(`/history`, {name: place_name});
            },
            initPlaceForm (){
                var input = document.getElementById('searchTextField');
                var autocomplete = new google.maps.places.Autocomplete(input, {types: ['(cities)']});
                    google.maps.event.addListener(autocomplete, 'place_changed',  () => {
                    let place = autocomplete.getPlace();
                    this.fetchGeoData(place);
                    this.saveInHistory(place.formatted_address);
                });
            }
        },
        mounted() {
            google.maps.event.addDomListener(window, 'load', this.initPlaceForm);
            this.fetchCitiesDB();
        }
    }
</script>
