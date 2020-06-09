<template>
  <section class="search">
    <div class="container">
      <div class="row">
        <div class="fakebox">
          <form >
            <input type="text" v-model="searchText" @keyup="search()" placeholder="Từ khóa...">
            <img src="./../assets/search2.png">
          </form>
          <p>Tìm kiếm theo tên phòng khám, theo tên bác, theo địa chỉ</p>
        </div>
      </div>
      <h4>Kết quả tìm kiếm</h4>
      <p class="result_S" v-if="countSearch">
        Tìm thấy {{countSearch}} phòng khám
      </p>
      <p class="result_S" v-else>
        Tìm thấy 0 phòng khám
      </p>
      <div class="row res_search">
        <router-link  :to="{name: 'phongkham',params: {idpk: res.id, tencs:res.tencs, sodtpk:res.sodtpk}}" v-for="res in items" v-bind:key="res.id">
          <div class="box_search">
            <div class="col m12">
              <h5>{{res.tencs}} - Bs. {{res.tenbs}}</h5>
            </div>
            <div class="col m6">
              <p><span>Chuyên khoa:</span> {{res.tenck}}</p>
            </div>
            <div class="col m6">
              <p><span>Địa chỉ:</span> {{res.diachi}}</p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script type="text/javascript">
export default{
  data(){
    return{
      searchText:'',
      countSearch:'',
      items:'',
    }
  },
  methods:{
    search(){
      this.axios
      .post("search", {
        keysearch: this.searchText
      })
      .then(response =>{
        this.countSearch  = response.data.countSearch
        this.items        = response.data.items
      })
    },
  },
}
</script>