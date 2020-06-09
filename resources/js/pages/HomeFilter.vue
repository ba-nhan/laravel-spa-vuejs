<template>
  <div>
    <section class="system_clinic screen_hide_mobile">
      <img src="./../../../public/img/background_virtual_media.jpg">
      <div class="bg_white">
        <div class="container container_90">
          <div class="row">
            <h1>Hệ thống phòng khám</h1>
            <router-link  
            :to="{ 
              name: 'phongkham', 
              params: {
                idpk: da.id, 
                tencs:da.tencs,
                sodtpk:da.sodtpk
              }

            }" v-for="da in items" v-bind:key="da.id">
              <div class="col m4 ">
                <div class="container_box">
                  <h6>{{ da.tencs }}</h6>
                  <p><span>Chuyên khoa: </span>{{ da.tenck }}</p>
                </div>
              </div>
            </router-link>
          </div>
          <div class="row">
            <div class="paginate">
              <button class="btn waves-effect waves-light" type="submit" @click="fetchStories(prev_page_url)" :disabled="!prev_page_url">
                <
              </button>
              <span>Page {{current_page}} of {{last_page}}</span>
              <button class="btn waves-effect waves-light" type="submit" @click="fetchStories(next_page_url)" :disabled="!next_page_url">
                >
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="system_clinic screen_hide_pc">
      <img src="./../../../public/img/background_virtual_media.jpg">
      <div class="bg_white">
        <div class="container container_90">
          <div class="row">
            <h1>Hệ thống phòng khám</h1>
            <router-link  
            :to="{ 
              name: 'phongkham', 
              params: {
                idpk: da.id, 
                tencs:da.tencs,
                sodtpk:da.sodtpk
              }

            }" v-for="da in items_mb" v-bind:key="da.id">
              <div class="col s12">
                <div class="container_box">
                  <h6>{{ da.tencs }}</h6>
                  <p><span>Chuyên khoa: </span>{{ da.tenck }}</p>
                </div>
              </div>
            </router-link>
          </div>
          <div class="row">
            <div class="paginate">
              <button class="btn waves-effect waves-light" type="submit" @click="fetchStories(prev_page_url_mb)" :disabled="!prev_page_url_mb">
                <
              </button>
              <span>Page {{current_page_mb}} of {{last_page_mb}}</span>
              <button class="btn waves-effect waves-light" type="submit" @click="fetchStories(next_page_url_mb)" :disabled="!next_page_url_mb">
                >
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="google_map">
      <div class="container container_90">
        <div class="row">
          <h1>Bản đồ hiển thị phòng khám</h1>
        </div>
      </div>
      <google-map />
    </section>
  </div>
</template>

    
<script type="text/javascript">

import GoogleMap from "./GoogleMap.vue";
export default{
  data(){
    return{
      items:'',
      total:'',
      current_page:'',
      last_page:'',
      next_page_url:'',
      prev_page_url:'',

      items_mb:'',
      total_mb:'',
      current_page_mb:'',
      last_page_mb:'',
      next_page_url_mb:'',
      prev_page_url_mb:'',
    }
  },
  components: {
    GoogleMap
  },
  created(){
    this.info()
  },
  updated(){
    this.info()
  },
  methods:{
    info(){
      this.axios
      .post('/filter_clinic',{
        id_chuyenkhoa:this.$route.params.id
      })
      .then(response => {
        // this.items=response.data
        this.items        = response.data.data.data
        this.total        = response.data.pagination.total
        this.current_page = response.data.pagination.current_page
        this.last_page    = response.data.pagination.last_page
        this.next_page_url= response.data.data.next_page_url
        this.prev_page_url= response.data.data.prev_page_url

        this.items_mb        = response.data.data_mb.data
        this.total_mb        = response.data.pagination_mb.total
        this.current_page_mb = response.data.pagination_mb.current_page
        this.last_page_mb    = response.data.pagination_mb.last_page
        this.next_page_url_mb= response.data.data_mb.next_page_url
        this.prev_page_url_mb= response.data.data_mb.prev_page_url
      })
      .catch(e => {this.errors.push(e)})
    },
    fetchStories(page_url) {
      this.axios
      .post(page_url)
      .then(response => {
        // this.items=response.data
        this.items        = response.data.data.data
        this.total        = response.data.pagination.total
        this.current_page = response.data.pagination.current_page
        this.last_page    = response.data.pagination.last_page
        this.next_page_url= response.data.data.next_page_url
        this.prev_page_url= response.data.data.prev_page_url
        
        this.items_mb        = response.data.data_mb.data
        this.total_mb        = response.data.pagination_mb.total
        this.current_page_mb = response.data.pagination_mb.current_page
        this.last_page_mb    = response.data.pagination_mb.last_page
        this.next_page_url_mb= response.data.data_mb.next_page_url
        this.prev_page_url_mb= response.data.data_mb.prev_page_url
      })
      .catch(e => {this.errors.push(e)})
    },
    clickCallback(pageNum){
      console.log(pageNum)
    },

  },
}
</script>