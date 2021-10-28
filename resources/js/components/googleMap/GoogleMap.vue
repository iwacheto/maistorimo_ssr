<template>
	<div class="google-map-box">
		<div class="google-map-text" v-if="!view">
			<h2>Адрес</h2>
            <p>* Посочете точен адрес, за да може картата на google да ви локализира. Натиснете бутона ‘’ Добави’’ след като изберете адреса си.</p>
			<label>
				<gmap-autocomplete
						:value="full_address"
						@place_changed="setPlace">
				</gmap-autocomplete>

				<button @click="addMarker">Добави</button>
			</label>

		</div>
		<gmap-map
				:center="center"
				:zoom="12"
				class="google-map-map"
				style="width:70%; height: 400px; margin: 32px 38px 50px 55px;"
		>
			<gmap-marker
					:position="marker.position"
					@click="center=marker.position"
			></gmap-marker>
		</gmap-map>
	</div>
</template>

<script>
	export default {
		name: "GoogleMap",
		props: ['lat', 'lng', 'formatted_address', 'placeObj','view'],
		data() {
			return {
				// default to Montreal to keep it simple
				// change this to whatever makes sense
				center: {lat: 45.508, lng: -73.587},
				marker: {position:{}},
				place: {},
				full_address:'',
				currentPlace: null
			};
		},
		mounted() {
			if(this.lat && this.lng && this.formatted_address && this.placeObj) {
				this.initialMarker();
			}

			this.geolocate();
		},

		methods: {
			initialMarker(){
				this.center.lat = parseFloat(this.lat);
				this.center.lng = parseFloat(this.lng);
				this.setPlace(this.placeObj);
				this.marker.position = {lat:this.center.lat, lng:this.center.lng};
				this.place=this.placeObj;
				this.full_address = this.formatted_address;
			},
			// receives a place object via the autocomplete component
			setPlace(place) {

				this.currentPlace = place;

			},
			addMarker() {

				if (this.currentPlace) {
					let marker = {};

						console.log('here');
						marker = {
							lat: this.currentPlace.geometry.location.lat(),
							lng: this.currentPlace.geometry.location.lng()
						};


					this.marker = {position: marker};

					this.place = this.currentPlace;
					this.center = marker;
					this.currentPlace = null;
					let data = {
						'lng': this.marker.position.lng,
						'lat': this.marker.position.lat,
						'formatted_address': this.place.formatted_address,
						'raw_data': this.place
					}
					this.full_address = this.place.formatted_address

					this.$store.commit('changePosition', data)
				}
			},
			geolocate: function () {
				navigator.geolocation.getCurrentPosition(position => {
					this.center = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
				});
			}
		}
	};
</script>

<style scoped>

	div {
		margin-top: 20px;
		border: unset;
        box-sizing: unset;
        box-shadow: unset;
        border-radius: unset;
	}

	h2 {
		font-weight: bold;
		font-size: 17px;
		line-height: 20px;
		color: #276955;
		margin-left: 38px;
		margin-bottom: 24px;
	}

	p {
		color: #565656;
        margin-left: 42px;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        width: 79%;
	}

	input {
		background: #FFFFFF;
		border: 0.75px solid #6BBF3F;
		box-sizing: border-box;
		box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		border-radius: 10px;
		width: 85%;
		margin: 0px auto 28px auto;
	}

	button {
		background: #FFFFFF;
		border: 0.75px solid #939393;
		box-sizing: border-box;
		box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		border-radius: 30.5px;
		font-style: normal;
		font-weight: normal;
		font-size: 17px;
		line-height: 20px;
		color: #000000;
		padding: 9px 36px;
		margin-left: 23px;
	}

	@media only screen and (min-width: 991px) {
		.google-map-box {
			display: flex;
			flex-direction: row;
			width: 100%;
		}

		.google-map-text {
			width: 35%;
		}
	}

	@media screen and (max-width: 990px) {
		
	}
</style>