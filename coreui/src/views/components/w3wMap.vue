<template>
  <what3words-map
    :current_location="!w3words ? true : false"
    current_location_control_position="2"
    :id="mapId"
    api_key="CVQHCR0K"
    map_api_key="AIzaSyAONdWlvzm8Jc8elwxfe4_hQwcjZDnAH38"
    zoom="8"
    selected_zoom="20"
    search_control_position="5"
    zoom_control
    fullscreen_control
    fullscreen_control_position="9"
    :words="w3words"
    street_view_control="true"
    map_type_control_position="1"
  >

    <div slot="map" id="map" v-bind:style="!this.mapDiv && 'display:none'"></div>
    <div slot="search-control" v-if="this.autoSuggest">

      <what3words-autosuggest id="what3words">
        <input type="text"/>
      </what3words-autosuggest>

      <a @click="switchNav" href="javascript:void(0)" class="font-weight-bold navigate-btn" :class="{ 'borderr-bottom': navigator }"><vue-fontawesome icon="compass"></vue-fontawesome>Navigate</a>
      <div v-if="navigator" class="boxshadow">

        <a  :href="'https://www.google.com/maps/dir/?api=1&amp;destination=' + lat + ','+  lng" target="_blank" rel="noopener noreferrer"><div class="ButtonIcon" data-testid="ButtonIcon-google"><svg viewBox="0 0 56 56" width="1em" height="1em" class="MuiSvgIcon-root"><path d="M21.2 38.5c1.3 1.7 2.7 3.8 3.4 5 .9 1.6 1.2 2.8 1.9 4.7.4 1.1.7 1.4 1.5 1.4s1.2-.6 1.5-1.4c.6-1.9 1.1-3.3 1.8-4.7 1.4-2.6 3.3-4.9 5.1-7.1.5-.6 3.6-4.3 5-7.2 0 0 1.7-3.2 1.7-7.6 0-4.2-1.7-7.1-1.7-7.1l-4.9 1.3-3 7.8-.7 1.1-.2.2-.2.2-.3.4-.5.5-2.6 2.2-6.6 3.8-1.2 6.5z" fill="#34a853"></path><path d="M14.3 28.7c1.6 3.7 4.7 6.9 6.8 9.8l11.2-13.3s-1.6 2.1-4.4 2.1c-3.2 0-5.8-2.5-5.8-5.7 0-2.2 1.3-3.7 1.3-3.7l-7.6 2-1.5 8.8z" fill="#fbbc04"></path><path d="M32.5 7.1c3.7 1.2 6.9 3.7 8.8 7.4l-8.9 10.7s1.3-1.5 1.3-3.7c0-3.3-2.8-5.7-5.7-5.7-2.8 0-4.4 2-4.4 2v-6.7l8.9-4z" fill="#4285f4"></path><path d="M16.4 11.8c2.2-2.6 6.1-5.4 11.5-5.4 2.6 0 4.6.7 4.6.7l-9 10.7h-6.4l-.7-6z" fill="#1a73e8"></path><path d="M14.3 28.7s-1.5-2.9-1.5-7.1c0-4 1.6-7.5 3.5-9.7l7.1 6-9.1 10.8z" fill="#ea4335"></path></svg><div class="ButtonIcon-Label">Google Maps</div></div></a>

      </div>

      

    </div>
  </what3words-map>
</template>
<script >

export default {
  name: "Autosuggest",
  props: {
    autoSuggest: Boolean,
    mapDiv: Boolean,
    mapId: String,
    w3words: String,
    lat: [Number, String],
    lng: [Number, String]
  },
  data() {
    return {
      navigator: false
      // words: null,
      // lat: null,
      // lng: null,
      // allData: null,
    }
  },
  methods: {
    switchNav(){
      this.navigator = !this.navigator;
    }
  },
  watch: {
  },
  mounted() {
    this.$nextTick(function () {
      const w3wMap = document.getElementById(this.mapId);
      w3wMap.addEventListener("selected_square", (data) => {
        // this.lat = await w3wMap.getLat();
        // this.lng = await w3wMap.getLng();
        this.$emit('getmapdata', data.detail)
      });
    });
  },
};
</script>
<style>
#map {
  width: 100%;
  height: 80vh;
}
html,
body {
  padding: 0px;
  margin: 0px;
  height: 100%;
}
.ButtonIcon-Label {
    font-size: 8px;
    color: #000;
}
.ButtonIcon svg {
    background-color: #fff;
    width: 48px;
    height: 48px;
    border-radius: 4px;
    margin-top:5px;
}
.ButtonIcon svg:hover {
    box-shadow: 0 0px 10px 0 #0000003d;
    background-color: #fff;
}
.navigate-btn{
    width: 100%;
    background-color: #005379;
    display: block;
    padding: 10px 20px;
    color: #fff;
    text-align: center;

}
.borderr-bottom {
  border-bottom: 4px solid #e11f26;
  transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}
.navigate-btn i {
    margin-right: 8px;
    font-size: 20px !important;
    margin-left: 0px;
}
.navigate-btn{
  color:#fff !important;
}

.boxshadow {
  text-align: center;
    box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%), 0px 1px 3px 0px rgb(0 0 0 / 12%);
}
</style>
