<template>
  <section class="save_result_khambenh">
    <div class="container">
      <div class="row">
        <h3>Lịch sử khám chữa bệnh</h3>
        <div class="box_history" v-for="ls in lichsu">
          <h4>{{ ls.tencs }}</h4>
          <p>Địa chỉ: {{ ls.diachi }}</p>
          <p class="format_p">ĐT: {{ ls.sodtpk }}
            <span class="screen_hide_mobile">Chuyên khoa: {{ ls.tenck }}</span>
            <span class="screen_hide_pc">CK: {{ ls.tenck }}</span>
          </p>

          <h5>Đơn thuốc</h5>
          <p class="format_p">Thời gian: {{moment(ls.thoigiandt).format("HH:mm, DD-MM-YYYY") }}
            <span class="screen_hide_mobile">Số khám bệnh: {{ ls.sokb }}</span>
            <span class="screen_hide_pc">Số KB: {{ ls.sokb }}</span>
          </p>
          <p>Chuẩn đoán: <span>{{ ls.chuandoan }}</span> </p>
          <p>Đơn thuốc: </p>
          <div class="toathuoc" v-for="th in thuoc" v-if="ls.id === th.toathuoc_id">
              <div class="row row_first" >
                <div class="col m8">
                  <span>{{ th.tenthuoc }}</span>
                </div>
                <div class="col m4">
                  {{ th.soluong }} 
                  <span v-if="th.dangthuoc =='chai'">Chai</span>
                  <span v-if="th.dangthuoc =='goi'">Gói</span>
                  <span v-if="th.dangthuoc =='vien'">Viên</span>
                </div>
              </div>
              <div class="row row_second">
                <div class="col m8">
                  Uống mỗi ngày {{ th.moingay }} lần, mỗi lần {{ th.moilan }}
                  <span v-if="th.dangthuoc =='chai'" style="font-weight: 500 !important">ml</span>
                  <span v-if="th.dangthuoc =='goi'" style="font-weight: 500 !important">gói</span>
                  <span v-if="th.dangthuoc =='vien'" style="font-weight: 500 !important">viên</span>
                </div>
                <div class="col m4">
                  Buổi: {{ th.buoi }}
                </div>
              </div>
          </div>
          <p v-if="ls.loidan">Lời dặn: {{ ls.loidan }}</p>
          <p v-else>Lời dặn: Không có</p>
          <p v-if="ls.taikham">Tái khám: {{moment(ls.taikham).format("DD-MM-YYYY") }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
<script type="text/javascript">
  import moment from 'moment'
  export default{
    data(){
      return{
        lichsu:'',
        thuoc:'',
        i:0,
      }
    },
    created(){
      this.history()
    },
    methods:{
      moment,
      history(){
        this.axios.get("lichsukbbn")
        .then(response=>{
          this.lichsu           = response.data.history_BN
          this.thuoc            = response.data.thuoc
        })
      }
    }
  }
</script>