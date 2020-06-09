<template>
  <div>
    <gmap-map ref="mymap" :center="startLocation" :zoom="14" style="width: 100%; height: 600px">
      <gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
        <div v-html="infoContent"></div>
      </gmap-info-window>
      <gmap-marker 
        v-for="(item, key) in phongkham" 
        :key="key" 
        :position="getPosition(item)" 
        :icon="{ 
          url: require('./../assets/marker/marker3.png'),
          size: {width: 51, height: 51, f: 'px', b: 'px'},
          scaledSize: {width: 51, height: 51, f: 'px', b: 'px'}
        }"
        @click="toggleInfo(item, key)" 
        />
    </gmap-map>
  </div>
</template>

<script>
export default {
  data() {
    return {
      startLocation: {
        lat: 10.063330 ,
        lng: 105.742050
      },
      infoPosition: null,
      infoContent: null,
      infoOpened: false,
      infoCurrentKey: null,
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -50
        }
      },
      phongkham:'',
    };
  },
  created () {
    this.phongkhamMaps()
  },
  methods: {
    getPosition(marker) {
      return {
        lat: parseFloat(marker.vido),
        lng: parseFloat(marker.kinhdo)
      }
    },
    toggleInfo(marker, key) {
      this.infoPosition = this.getPosition(marker)
      this.infoContent =  this.getInfoWindowContent(marker);
      if (this.infoCurrentKey == key) {
        this.infoOpened = !this.infoOpened
      } else {
        this.infoOpened = true
        this.infoCurrentKey = key
      }
    },
    getInfoWindowContent(marker) {
      return (`
        <div class="map_box">
          <h6>${ marker.tencs }</h6>
          <p><span>Chuyên khoa: </span>${ marker.tenck }</p>
        </div>
        <a target="_blank" href="http://www.google.com/maps/place/${ marker.vido },${ marker.kinhdo }"> <span>Xem trên Google Maps</span> </a>
      `);
    },
    phongkhamMaps(){
      this.axios.get("phongkham")
      .then(response=>{
        this.phongkham = response.data
      })
    }
  }
};
</script>
