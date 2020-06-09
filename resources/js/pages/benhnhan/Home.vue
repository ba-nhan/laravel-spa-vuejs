<template>
  	<section class="info_phongkham_benbs">
		<div class="container">
			<!-- Kiểm tra phòng khám đã đăng kí thông tin chưa thông qua $countE -->
			<div v-if="countE == 0" class="exist">
				Đăng kí thông tin bệnh nhân <router-link to="/luu-hoso-benh-nhan">Tại đây</router-link>
			</div>
			<div v-else class="row no_border" v-for="res in datas" >
				<h3>Thông tin bệnh nhân</h3>
				<div class="row">
					<div class="col m3 s6">
						<p>Họ và tên</p>
					</div>
					<div class="col m9 s6">
						<p>{{ res.tenbn}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Giới tính</p>
					</div>
					<div class="col m9 s6">
						<p>{{ res.gioitinhbn}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Ngày sinh</p>
					</div>
					<div class="col m9 s6">
						<p>{{ res.namsinhbn}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Số điện thoại</p>
					</div>
					<div class="col m9 s6">
						<p>{{ res.sodtbn}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Chứng minh nhân dân</p>
					</div>
					<div class="col m9 s6">
						<p>{{ res.socmbn}}</p>
					</div>
				</div>
				<div class="row r_end" >
					<div class="col m3 s2">
						<p>Địa chỉ</p>
					</div>
					<div class="col m9 s10">
						<p>{{ res.diachibn}}</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script type="text/javascript">
export default{
	data(){
		return{
			datas:null,
			countE:null,
		}
	},
	created(){
      this.info()
    },
	methods:{
		info(){
			this.axios
			.get('/hosobn')
       		.then(response => {
       			this.datas=response.data.result
       			this.countE=response.data.countE
       		})
       		.catch(e => {this.errors.push(e)})
		}
	},
}
</script>