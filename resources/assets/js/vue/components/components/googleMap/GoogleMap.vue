<template>
	<div>
		<div v-if="!view">
			<h2>Адрес</h2>
            <span>* Посочете точен адрес, за да може картата на google да ви локализира. Натиснете бутона ‘’ Добави’’ след като изберете адреса си.</span>
			<label>
				<gmap-autocomplete
						:value="full_address"
						@place_changed="setPlace">
				</gmap-autocomplete>

				<button @click="addMarker">Добави</button>
			</label>
			<br/>

		</div>
		<br>
		<gmap-map
				:center="center"
				:zoom="12"
				style="width:100%;  height: 400px;"
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
