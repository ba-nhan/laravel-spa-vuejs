<template>
  	<section class="info_phongkham_benbs">
		<div class="container">
			<!-- Kiểm tra phòng khám đã đăng kí thông tin chưa thông qua $countE -->
			<div v-if="countE == 0" class="exist">
				Đăng kí thông tin phòng khám <router-link to="/luu-hoso-bac-si">Tại đây</router-link>
			</div>
			<div v-else class="row no_border" v-for="inf in infor">
				<h3 class="no-margin-top">Thông tin đăng kí phòng khám</h3>
				<div class="row" >
					<div class="col m3 s4">
						<p>Tên phòng khám</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.tencs }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Ngày cấp phép hoạt động</p>
					</div>
					<div class="col m9 s6">
						<p>{{ inf.ngaycp }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Tên bác sĩ</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.tenbs }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Ngày sinh bác sĩ</p>
					</div>
					<div class="col m9 s6">
						<p>{{ inf.nsbs }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Giới tính</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.gioitinhbs }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s6">
						<p>Trình độ</p>
					</div>
					<div class="col m9 s6">
						<p>{{ inf.trinhdo }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Chuyên khoa</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.tenck }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Nơi công tác</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.name }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Địa chỉ hành nghề</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.diachi }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Số điện thoại phòng khám</p>
					</div>
					<div class="col m9 s8">
						<p>{{ inf.sodtpk }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col m3 s4">
						<p>Khung thời gian khám:</p>
					</div>
					<div class="col m9 s8">
						<p>
							<span v-if="time_s1">
							{{ time_s1 }} - {{ time_e1 }}
							</span>
							<span v-if="time_s2 !== '00:00'">
								, {{ time_s2 }} - {{ time_e2 }}
							</span>
							<span v-if="time_s3 !== '00:00'">
								, {{ time_s3 }} - {{ time_e3 }}
							</span>
						</p>
					</div>
				</div>
				<div class="row" >
					<div class="col m3 s6">
						<p>Thời gian khám trung bình (đv: Phút)</p>
					</div>
					<div class="col m9 s6">
						<p>{{ inf.timetb }}</p>
					</div>
				</div>
				<div class="row r_end" >
					<div class="col m3 s6">
						<p>Vị trí trên bản đồ:</p>
					</div>
					<div class="col m9 s6">
						<p>Vĩ độ: {{ inf.vido }}, kinh độ: {{ inf.kinhdo }}</p>
					</div>
				</div>
				<div v-if="inf.iframe_map">
					<h3>Thông tin chỉ đường Google Map</h3>
					<div class="map" v-html="inf.iframe_map">
					</div>
				</div>
				<div v-else>
					<h3>Thông tin chỉ đường Google Map<span> (Thông tin rỗng)</span></h3>
				</div>
			</div>
		</div>
	</section>
</template>

<script type="text/javascript">

export default{

	data(){
		return{
			title: 'Welcome to <br/> Arrow GTP',
			infor:null,
			time_s1:null,
			time_s2:null,
			time_s3:null,
			time_e1:null,
			time_e2:null,
			time_e3:null,
			countE: null,
		}
	},
	created(){
      this.info()
    },
	methods:{
		info(){
			this.axios
			.get('/hosobs')
       		.then(response => {
       			this.infor=response.data.info
       			this.time_s1=response.data.time_s1
       			this.time_s2=response.data.time_s2
       			this.time_s3=response.data.time_s3
       			this.time_e1=response.data.time_e1
       			this.time_e2=response.data.time_e2
       			this.time_e3=response.data.time_e3
       			this.countE=response.data.countE
       		})
       		.catch(e => {this.errors.push(e)
       		})
		}
	},
}
</script>