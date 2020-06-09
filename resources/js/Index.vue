<template>
    <div id="app">
      <section class="header">
        <div class="row screen_hide_mobile">
          <!-- Điều hướng logo  -->
          <div class="col m2" v-if="$auth.user().role === 2">
              <router-link to="/bac-si"><img src="./../../public/img/med-tech-icon-hub.png"></router-link>
          </div>
          <div class="col m2" v-else>
              <router-link to="/"><img src="./../../public/img/med-tech-icon-hub.png"></router-link>
          </div>

          <!-- Tên tiêu đề -->
          <div class="col m8" v-if="$auth.user().role === 2 ">
            <h1><name></name></h1>
          </div>
          <div class="col m8" v-if="this.$route.params.tencs " >
            <h1>{{ this.$route.params.tencs }}</h1>
          </div>
          <div class="col m8" v-if="!$auth.check() && !this.$route.params.tencs || $auth.user().role === 1 && !this.$route.params.tencs" >
            <h1>{{ title }}</h1>
          </div> 
          <!-- Button login -->
          <div class="col m2 login">
            <router-link to="/login" v-if="!$auth.check()">Đăng nhập</router-link>
            <div v-if="$auth.check()">Hi, {{ $auth.user().email }}</div>
            <a href="#" @click.prevent="$auth.logout()" v-if="$auth.check()">Đăng xuất</a>
          </div>
        </div>

        <!-- Thanh điều hướng -->
        <nav class="menu-pc">
          <!-- Hotline -->
          <div class="row">
            <div class="col m3" v-if="this.$route.params.sodtpk">
              <p>Hotline: <span>{{ this.$route.params.sodtpk }}</span></p>  
            </div>
            <div class="col m3" v-else>
              <p>Hotline: <span>0353 116 200</span></p>  
            </div>

            <!-- Route điều hướng -->
            <div class="col m7">
              <ul v-if="$auth.user().role === 1">
                <li >
                  <router-link to="/thong-tin-benh-nhan">Thông tin<hr></router-link>
                </li>
                <li >
                  <router-link to="/lich-su-kham-benh">Lịch sử khám<hr></router-link>
                </li>
                <li v-if="this.$route.params.idpk">
                  <router-link :to="{
                    name:'bangtin',
                    params:{
                      id: this.$route.params.idpk,
                      tencs:this.$route.params.tencs
                    }
                  }">
                  Bảng tin<hr></router-link>
                </li>
              </ul>

              <ul>
                <li v-if="!$auth.check()">
                  <router-link to="/register">Đăng kí thành viên<hr></router-link>
                </li>
                <li v-if="this.$route.params.idpk && !$auth.check()">
                  <router-link :to="{
                    name:'bangtin',
                    params:{
                      id: this.$route.params.idpk,
                      tencs:this.$route.params.tencs
                    }
                  }">
                  Bảng tin<hr></router-link>
                </li>
                <li class="register" v-if="!$auth.check() || $auth.user().role === 1">
                  <a class='dropdown-trigger dropdown-button' href='#' data-target='dropdown'>
                    Chuyên khoa <i class="material-icons dropdown_menu">arrow_drop_down</i>
                  </a>
                  <ul id='dropdown' class='dropdown-content dropdown_content'>
                    <li v-for="ck in ds_chuyenkhoa" @click="submit_ck(ck.id)" v-bind:key="ck.id">{{ck.tenck}}</li>
                  </ul>
                </li>
              </ul>

              <ul v-if="$auth.user().role === 2">
                <li >
                  <router-link to="/bac-si">Thông tin<hr></router-link>
                </li>
                <li >
                  <router-link to="/bac-si/danh-sach-kham-benh">Danh sách bệnh nhân<hr></router-link>
                </li>
                <li >
                  <router-link to="/bac-si/dang-tin">Đăng tin<hr></router-link>
                </li>
                <li >
                  <router-link to="/bac-si/tin-tuc">Tin tức<hr></router-link>
                </li>
              </ul>
            </div>
            
            <div class="col m2 search" v-if="$auth.user().role !== 2">
              <router-link to="/tim-kiem"><span>Tìm kiếm</span><img src="./../../public/img/search.png"></router-link>
            </div>
          </div>
      </nav>
      </section>
      <section class="header_mb screen_hide_pc">
        <nav class="menu-mb">
          <div class="row">
            <div class="col s10">
              <!-- Điều hướng logo  -->
              <div v-if="$auth.user().role === 2" class="height_56">
                  <router-link to="/bac-si"><img src="./../../public/img/med-tech-icon-hub.png"></router-link>
              </div>
              <div v-else class="height_56">
                  <router-link to="/"><img src="./../../public/img/med-tech-icon-hub.png"></router-link>
              </div>
              
              <!-- Tên tiêu đề -->
              <div  v-if="$auth.user().role === 2 ">
                <h1><name></name></h1>
              </div>
              <div  v-if="this.$route.params.tencs " >
                <h1>{{ this.$route.params.tencs }}</h1>
              </div>
              <div  v-if="!$auth.check() && !this.$route.params.tencs || $auth.user().role === 1 && !this.$route.params.tencs" >
                <h1>{{ title }}</h1>
              </div>
            </div>
            <div class="col s2">
              <!-- Dropdown Trigger -->
              <a class='dropdown-trigger btn show_position' href='#' data-target='dropdown1'><i class="fa fa-bars"></i></a>
              <!-- Dropdown Structure -->
              <ul id='dropdown1' class='dropdown-content pos_dropdown2'>
                <ul v-if="$auth.user().role === 1">
                  <li>
                    <router-link to="/thong-tin-benh-nhan">Thông tin</router-link>
                  </li>
                  <li>
                    <router-link to="/lich-su-kham-benh">Lịch sử khám</router-link>
                  </li>
                  <li v-if="this.$route.params.idpk">
                    <router-link :to="{name:'bangtin',query:{id: this.$route.params.idpk}}">Bảng tin</router-link>
                  </li>
                </ul>

                <ul>

                  <li v-if="this.$route.params.idpk && !$auth.check()">
                    <router-link :to="{
                      name:'bangtin',
                      params:{
                        id: this.$route.params.idpk,
                        tencs:this.$route.params.tencs
                      }
                    }">
                    Bảng tin</router-link>
                  </li>
                  <div v-if="!$auth.check() || $auth.user().role === 1">
                    <li><router-link to="/tim-kiem">Tìm kiếm</router-link></li>
                    <li>Chuyên khoa</li>
                    <ul class="child_dropdown">
                       <li v-for="ck in ds_chuyenkhoa" @click="submit_ck(ck.id)" v-bind:key="ck.id">{{ck.tenck}}</li>
                    </ul>
                  </div>
                    
                </ul>

                <ul v-if="$auth.user().role === 2">
                  <li >
                    <router-link to="/bac-si">Thông tin</router-link>
                  </li>
                  <li >
                    <router-link to="/bac-si/danh-sach-kham-benh">Danh sách bệnh nhân</router-link>
                  </li>
                  <li >
                    <router-link to="/bac-si/dang-tin">Đăng tin</router-link>
                  </li>
                  <li >
                    <router-link to="/bac-si/tin-tuc">Tin tức</router-link>
                  </li>
                </ul>
              </ul>
            </div>
          </div>
        </nav>
      </section>
      <section class="element_hide_below_header screen_hide_pc">
        <!-- do header sử dụng position:fixed -->
      </section>
      <router-view/>
      <section class="footer">
        <div class="container">
          <div class="row">
            <div class="col m4 s12 mobile">
              <img src="./../../public/img/med-tech-icon-hub.png">
              <p><span class="text-first">H</span>ệ thống của chúng tôi tự động hóa trong việc đang kí lấy số khám chữa bệnh. </p>
            </div>
            <div class="col m1">
              
            </div>
            <div class="col m7 s12 contact">
              <h4>Về chúng tôi</h4>
              <p>Thông tin liên hệ hỗ trợ:</p>
              <ul>
                <li>Address: quận Ninh Kiều, TP. Cần Thơ</li>
                <li>Hotline: 0353 116 200</li>
                <li>Mail: nhanb1509701@student.ctu.edu.vn</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-crossbar">
          <span>Copyright by nhan1509701</span>
        </div>
      </section>
      <section class="login_mobile screen_hide_pc">
        <div class="container">
          <div class="row">
            <div v-if="$auth.check()">
              <div class="col s6">
                <div class="box_frame_a1" >
                  Hi, {{ $auth.user().email }}
                </div>
              </div>
              <div class="col s6">
                <div class="box_frame_a2">
                  <a href="#" @click.prevent="$auth.logout()">Đăng xuất</a>
                </div>
              </div>
            </div>
            <div v-else>
              <div class="col s6">
                  <div class="box_frame_a1">
                    <router-link to="/register">Đăng kí thành viên<hr></router-link>
                  </div>
                </div>
                <div class="col s6">
                  <div class="box_frame_a2">
                    <router-link to="/login" v-if="!$auth.check()">Đăng nhập</router-link>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</template>


<script type="text/javascript">

  import name from './pages/Name.vue'

  export default {
    data(){
        return {
          title:"Hệ thống phòng khám tư",
          ds_chuyenkhoa:'',
          id_chuyenkhoa:'',
          idchuyenkhoa:'',
          id:'',
          ten_cs:''
        }
    },
    created(){
      this.list_chuyenkhoa()
      // this.tenpk()
    },
    components: {
      name
    },    
    mounted () {
      M.AutoInit()
    },
    methods:{
      list_chuyenkhoa(){
        this.axios
        .get("/dschuyenkhoa")
        .then(res =>{
          this.ds_chuyenkhoa = res.data
        })
        .catch(e => {
          console.log(e)
        })
      },
      submit_ck(idchuyenkhoa){
        // NavigationDuplicated: Điều hướng bị trùng lập khi sử dụng params ROUTE
        this.$router.push({ name: 'homefilter',params: { id: idchuyenkhoa }})
      },
      // tenpk(){
      //   // tại sao vue-auth không hoạt động
      //   this.axios.post('/tenphongkham',{
      //     id: this.$auth.user().id
      //   })

      // }
    }, 
  }
</script>