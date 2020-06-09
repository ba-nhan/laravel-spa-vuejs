<template>
<section class="bs-file-setting">
    <h1>Hoàn thành hồ sơ đăng ký phòng khám</h1>
    <div class="container container-50">
      <div class="row no-margin-bottom">
        <form method="POST" @submit.prevent="submit">
          <h3>Điền đầy đủ tất cả các trường thông tin</h3>
          <div class="row">
            <div class="col s12">
              <label for="tencs">Tên cơ sở phòng khám</label>
              <input placeholder="Nhập tên phòng khám" id="tencs" type="text" name="tencs" v-model="fields.tencs">
              <div v-if="errors.tencs" class="text-danger">{{ errors.tencs[0] }}</div>
            </div>
            <div class="col s12">
              <label for="ngaycp">Ngày cấp phép</label>
              <input id="ngaycp" type="date" name="ngaycp" v-model="fields.ngaycp">
              <div v-if="errors.ngaycp" class="text-danger">{{ errors.ngaycp[0] }}</div>
            </div>
            <div class=" col s12">
              <label for="tenbs">Họ và tên bác sĩ:</label>
              <input placeholder="Nhập tên bác sĩ" id="tenbs" type="text" name="tenbs" v-model="fields.tenbs">
              <div v-if="errors.tenbs" class="text-danger">{{ errors.tenbs[0] }}</div>
            </div>
            <div class="col s12">
              <label for="date">Ngày sinh:</label>
              <input id="date" type="date" name="nsbs" v-model="fields.nsbs">
              <div v-if="errors.nsbs" class="text-danger">{{ errors.nsbs[0] }}</div>
            </div>
            <div class="col s12">
              <p class="gender">Giới tính: 
                <label>
                  <input name="gtbs" type="radio" id="nam" value="Nam" v-model="fields.gtbs"/>
                  <span>Nam</span>
                </label>
                <label>
                  <input name="gtbs" type="radio" id="nu" value="Nữ" v-model="fields.gtbs"/>
                  <span>Nữ</span>
                </label>
              </p>
              <div v-if="errors.gtbs" class="text-danger">{{ errors.gtbs[0] }}</div>
            </div>
            <div class="col s12">
              <p>Trình độ chuyên môn bác sĩ:</p>
              <select class="browser-default" name="trinhdobs" v-model='fields.trinhdobs'>
                <option value="" disabled selected>Chọn trình độ</option>
                <option v-for="td in trinhdo" v-bind:value="td.id">{{ td.trinhdo }}</option>
              </select>
              <div v-if="errors.trinhdobs" class="text-danger">{{ errors.trinhdobs[0] }}</div>
            </div>
            <div class="col s12">
              <p>Chuyên khoa bác sĩ:</p>
              <select class="browser-default" name="tenck" v-model='fields.tenck'>
                <option value="" disabled selected>Chọn chuyên khoa</option>
                <option v-for="ck in chuyenkhoa" v-bind:value="ck.id">{{ ck.tenck }}</option>
              </select>
              <div v-if="errors.tenck" class="text-danger">{{ errors.tenck[0] }}</div>
            </div>
            <div class="col s12">
              <p>Nơi công tác bác sĩ:</p>
              <div class="row">
                <div class="col m6"> 
                  <select class="browser-default se_again" name="tinh" id="tinh" v-model='id_tinh' @change="onChange">
                    <option value="" disabled selected>Chọn tỉnh</option>
                    <option v-for="t in tinhct" v-bind:value="t.id" >{{ t.name }}</option>
                  </select>
                </div>
                <div class="col m6"> 
                  <select class="browser-default se_again" name="noicongtac" id="noicongtac" v-model="fields.noicongtac">
                    <option value="" disabled selected>Vui lòng chọn tỉnh</option>
                    <option v-for="n in noi" v-bind:value="n.id">{{ n.name }}</option>
                  </select>
                </div>
              </div>
              <div v-if="errors.tinh || errors.noicongtac" class="text-danger">{{ errors.noicongtac[0] }}</div>
            </div>
            <div class="col s12">
              <label for="diachipk">Địa chỉ hành nghề</label>
              <input placeholder="Nhập địa chỉ phòng khám" id="diachipk" type="text" name="diachipk" v-model="fields.diachipk">
              <div v-if="errors.diachipk" class="text-danger">{{ errors.diachipk[0] }}</div>
            </div>
            <div class=" col s12">
              <label for="sodtpk">Số điện thoại phòng khám:</label>
              <input placeholder="Nhập số điện thoại phòng khám" id="sodtpk" type="number" name="sodtpk" v-model="fields.sodtpk">
              <div v-if="errors.sodtpk" class="text-danger">{{ errors.sodtpk[0] }}</div>
            </div>
            <div class="col s12 format_time">
              <p class="format_p">Thời gian:
                <!-- <img src="./../../assets/icon_add.webp" v-on:click="add_fields"> -->
              </p> 
              <div class="div_f" id='about_time'>
                <span>Từ 
                  <input type="time" name="timestart" v-model="fields.timestart"> 
                  đến 
                  <input type="time" name="timeend" v-model="fields.timeend">
                </span>
                <div v-if="errors.timestart || errors.timeend" class="text-danger">{{ errors.timestart[0] }}</div>
              </div>
              <div class="div_f" id='about_time'>
                <span>Từ 
                  <input type="time" v-model="fields.timestart2"> 
                  đến 
                  <input type="time" v-model="fields.timeend2">
                </span>
                <div v-if="errors.timestart2 || errors.timeend2" class="text-danger">Hoàn thành đầy đủ</div>
              </div>
              <div class="div_f" id='about_time'>
                <span>Từ 
                  <input type="time" v-model="fields.timestart3"> 
                  đến 
                  <input type="time" v-model="fields.timeend3">
                </span>
                <div v-if="errors.timestart3 || errors.timeend3" class="text-danger">Hoàn thành đầy đủ</div>
              </div>

            </div>
            <div class="col s12">
                <label for="timetb">Thời gian khám bệnh trung bình / một bệnh nhân (đơn vị: Phút):</label>
                <input id="timetb" type="number" name="timetb" placeholder="Nhập số phút" v-model="fields.timetb">
                <div v-if="errors.timetb" class="text-danger">{{ errors.timetb[0] }}</div>
            </div>
            <div class="col s12">
              <p>Chọn giao diện phòng khám
              <div class="col s6">
                <label>
                  <input name="layoutpk" type="radio" value="1" v-model="fields.layoutpk"/>
                  <span><img src="./../../assets/layout1.png"></span>
                </label>
              </div>
              <div class="col s6">
                <label>
                  <input name="layoutpk" type="radio"  value="2" v-model="fields.layoutpk"/>
                  <span><img src="./../../assets/layout2.png"></span>
                </label>
              </div>
              
              </p>
              <div v-if="errors.layoutpk" class="text-danger">{{ errors.layoutpk[0] }}</div>
            </div>
            <div class="col s12">
              <p>Chỉ đường bằng Google Map: <span class="note_warning">(Không bắt buộc)</span></p>
              <input type="text" name="iframe_map" placeholder="Sao chép thẻ iframe dán vào đây" v-model="fields.iframe_map">
              <p>Hướng dẫn cách lấy iframe: <a href= "https://themevi.com/cach-lay-iframe-google-maps-de-chen-vao-website/" target="_blank"> Tại đây </a></p>
            </div>
            <div class="col s12">
              <p>Thêm đánh dấu trên bản đồ: <span class="note_warning">(Không bắt buộc)</span></p>
              <div v-if="errors.vido || errors.kinhdo" class="text-danger">Nhập đầy đủ vĩ độ và kinh độ</div>
              <div class="col s6">
                <input type="number" step=any placeholder="Vĩ độ" v-model="fields.vido">
              </div>
              <div class="col s6">
                <input type="number" step=any placeholder="Kinh độ" v-model="fields.kinhdo">
              </div>
              <p>Tìm vĩ độ và kinh độ: <a href= "https://www.latlong.net/" target="_blank"> Tại đây </a></p>
            </div>
            <div v-if="existt" class="exist">Đã đăng kí thông tin cho phòng khám
              <a href="/bac-si">Tại đây</a>
            </div>
            <div class="col s12 btn-save">
              <button class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  </div>
</template>
<script type="text/javascript">
var num = 1;
export default{
  data(){
    return{
      trinhdo:null,
      chuyenkhoa:null,
      tinhct:null,
      id_tinh:'',
      noi:{},
      fields:{},
      errors: {},
      existt:'',
    }
  },
  created(){
    this.trinhdobacsi()
    this.chuyenkhoabacsi()
    this.tinhcongtac()
  },
  methods:{
    trinhdobacsi(){
      this.axios
      .get('/trinhdo')
      .then(response => {this.trinhdo = response.data})
    },
    chuyenkhoabacsi(){
      this.axios
      .get('/chuyenkhoa')
      .then(response => {this.chuyenkhoa = response.data})
    },
    tinhcongtac(){
      this.axios
      .get('/tinh')
      .then(response => {this.tinhct = response.data})
    },  
    onChange(){
      this.axios
      .post('/noicongtac', {id: this.id_tinh})
      .then(response => {this.noi = response.data})
    },
    add_fields(){
      num ++;
      if(num <= 3){
        var obj = document.getElementById("about_time");
        var divTime = document.createElement("div");
        divTime.innerHTML = '<div class="div_f" id="about_time'+ num +'"><span>Từ <input type="time" name="timestart'+ num +'" v-model="fields.timestart'+ num +'"> đến <input type="time" name="timeend'+ num +'" v-model="fields.timeend'+ num +'"></span></div>';
        obj.appendChild(divTime);
      }else{
        document.getElementById("about_time").disabled=true;
      }
    },
    submit(){
      this.axios
      .post("luuhosobs", this.fields)
      .then(response => {
        if(response.data === 'exist'){
          this.existt = true
        }
        else{
          this.$router.push('/bac-si');
        }
      })
      .catch(error =>{
        // console.log(error)
        if (error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        }
      })
    }
  }
}

</script>