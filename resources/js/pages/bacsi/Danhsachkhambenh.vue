<template>
  	<section class="show_patient">
		<div class="container">
			<h3>Danh sách bệnh nhân khám bệnh</h3>
		</div>
		<div class="container format_con">
			<div class="row screen_hide_mobile">
				<div class="row format_r_title">
					<div class="col m2">Khung thời gian</div>
					<div class="col m1">STT</div>
					<div class="col m2">Họ và tên</div>
					<div class="col m2">Giới tính</div>
					<div class="col m2">Số điện thoại</div>
					<div class="col m3">Địa chỉ</div>
				</div>
		        <router-link  
		          :to="{ 
		            name: 'luuketquakb', 
		            params: {
		              iddk: da.id, 
		            }}" v-for="da in list_patient" v-bind:key="da.id" ><!-- v-if="timeNow >= da.timestart" -->
		            <div class="row format_r" >
						<div class="col m2">{{moment(da.timestart, "HH:mm:ss").format("HH:mm") }} - {{moment(da.timeend, "HH:mm:ss").format("HH:mm") }}</div>
						<div class="col m1" >{{da.sokb}} 
							<span v-for="c in check" v-if="da.sokb === c.sokb && da.timestart === c.timestart" >
								(*)
							</span>
						</div>
						<div class="col m2">{{da.tenbn}}</div>
						<div class="col m2">{{da.gioitinhbn}}</div>
						<div class="col m2">{{da.sodtbn}}</div>
						<div class="col m3">{{da.diachibn}}</div>
					</div>
		        </router-link>
		        <span>(*) Đã lưu thông tin khám bệnh cho bệnh nhân</span>
			</div>
			<div class="row screen_hide_pc">
				<div class="row format_r_title">
					<div class="col s5">Khung thời gian</div>
					<div class="col s2">STT</div>
					<div class="col s5">Họ và tên</div>
				</div>
		        <router-link  
		          :to="{ 
		            name: 'luuketquakb', 
		            params: {
		              iddk: da.id, 
		            }}" v-for="da in list_patient" v-bind:key="da.id" ><!-- v-if="timeNow >= da.timestart" -->
		            <div class="row format_r">
						<div class="col s5">{{moment(da.timestart, "HH:mm:ss").format("HH:mm") }} - {{moment(da.timeend, "HH:mm:ss").format("HH:mm") }}</div>
						<div class="col s2">{{da.sokb}}
							<span v-for="c in check" v-if="da.sokb === c.sokb && da.timestart === c.timestart" >
								(*)
							</span>
						</div>
						<div class="col s5">{{da.tenbn}}</div>
					</div>
		        </router-link>
		        <span>(*) Đã lưu thông tin khám bệnh cho bệnh nhân</span>
			</div>
		</div>
	</section>
</template>
<script type="text/javascript">
	import moment from 'moment'
	export default{
		data(){
			return{
				list_patient:'',
				time_start:'',
				time_end:'',
				timeNow:'',
				check:[],
			}
		},
		created(){
			this.hienthidanhsachkb()
		},
		methods:{
			moment,
			hienthidanhsachkb(){
				this.axios.get('/hienthiDSKB')
				.then(response =>{
					this.list_patient	= response.data.list_patient
					this.time_start 	= response.data.time_start
					this.time_end 		= response.data.time_end
					this.timeNow 		= response.data.timeNow
					this.check 			= response.data.check
				})
				.catch(error =>{

				})
			}
		}
	}
</script>
