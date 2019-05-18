<template>
    <div class="google-map h-100 bg-light" style="display:flex; width:100%; flex-wrap: wrap" >
        <div 
            class="control-box d-flex bg-secondary shadow"
            :class="{
                    'is-open' : menuOpen,
                    'is-closed' : !menuOpen    
                }"
        >
            <div class="category-selector p-3" >
                <div v-for="category in categories" :key="category.index" class="custom-control custom-checkbox" >
                    <input type="checkbox" class="custom-control-input m-0" :value="category.name" v-model="selectedCategories" :id="category.slug + '-control'" >
                    <label class="text-white m-0 custom-control-label" :for="category.slug + '-control'">{{ category.name }}</label>
                </div>

                <button @click="toggleMenu()" class="btn btn-sm btn-outline-white mt-3" >close filters</button>
            </div>
            <div class="filter-button" v-if="!menuOpen">
                <div class="rotate">
                <button @click="toggleMenu()" class="btn btn-sm btn-secondary" >FILTER ATTRACTIONS</button>
                </div>
            </div>
        </div>
        <div ref="adventuremap" id="adventuremap" class="h-100" style="min-height: 600px; flex-grow:1" ></div>
    </div>
</template>

<script>
import GoogleMap from '../services/google-maps.service.js';

    export default {
        props: {
            latitude: {
                type: Number,
                default: this.latitude
            },
            longitude: {
                type: Number,
                default: this.longitude
            },
            zoom: {
                type: Number,
                default: this.zoom
            },
            api: {
                type: String,
                default: ''
            }
        },

        data() {
            return {
                renderedMap: {},
                config: {},
                isLoading: true,
                errors: [],
                categories: [],
                selectedCategories: [],
                menuOpen: false,
                params: '',
                config: {
                    zoom: this.zoom,
                    center: {
                        latitude: this.latitude,
                        longitude: this.longitude
                    },
                    mapElement: this.$refs.adventuremap,
                    markers: [],
                    origin: {}
                }
            }
        },

        watch: {
            selectedCategories: function () {
                this.config.markers = [];
                this.buildQuery();
                this.getMarkers();
            }
        },

        mounted () {
            this.renderMap();
            this.getVenueCategories();
        },

        methods: {

            toggleMenu() {
                this.menuOpen = ! this.menuOpen;
            },

            renderMap() {
                let vm = this;

                this.renderedMap = new GoogleMap(this.config, this.api)
                    .load()
                    .then(response => {
                        vm.getMarkers();
                    });
                
            },

            buildQuery() {
                let queryString = '';
                let i = 0;
                Object.keys(this.selectedCategories).forEach(key => {
                    queryString += (i == 0 ? '?' : '&')  + 'category[]=' + this.selectedCategories[key];
                    i++;
                });
                this.params = queryString;
            },

            getMarkers() {
                let vm = this;

                http.get("/wp-json/kerigansolutions/v1/map" + this.params)
                .then(response => {
                    response.data.forEach(pin => {
                        vm.config.markers.push(pin);
                    })
                    this.renderedMap = new GoogleMap(this.config, this.api)
                        .drawMarkers()
                })
                .catch(e => {
                    this.errors.push(e.message)
                })
                
            },

            getVenueCategories() {
                let vm = this;

                http.get("/wp-json/kerigansolutions/v1/map-categories")
                .then(response => {
                    response.data.forEach(category => {
                        vm.categories.push(category);
                    })
                })
            }

        }

    }
</script>
<style lang="less">
.control-box {
    height: 100%;
    position: absolute;
    left: -175px;
    transition: left linear .25s;
    z-index: 5;

    &.is-open {
        left: 0;
    }

    button {
        border: 0;
        white-space: nowrap;
        padding: .5rem 1rem .25rem;
        font-size: 1.1em;
    }

    .category-selector {
        width: 175px;

        .custom-control {
            padding-left: 1.5rem !important;

            .custom-control-label::after,
            .custom-control-label::before {
                left: -1.5rem !important;
            }
        }
    }

    .filter-button {
        align-self: center;

        .rotate {
            transform: rotate(-90deg);
            position: absolute;
            width: 46px;
        }
    }
}
</style>
