<template>
    <section>
    	<section v-for="inf in infor" v-if="inf.layout ===1">
    		<section class="takeNumber" >
	    		<div class="container">
		            <div class="row">
		            	<div class="radio_time">
		            		<button class="btn" v-if="time_s1" v-on:click="seen = 1" @click="showNum(id_frame1, sokb_frame1)">
		            			{{ time_s1 }} - {{ time_e1 }}
		            		</button>
		            		<button class="btn" v-if="time_s2 !== '00:00'" v-on:click="seen = 2" @click="showNum(id_frame2, sokb_frame2)">
		            			{{ time_s2 }} - {{ time_e2 }}
		            		</button>
		            		<button class="btn" v-if="time_s3 !== '00:00'" v-on:click="seen = 3" @click="showNum(id_frame3, sokb_frame3)">
		            			{{ time_s3 }} - {{ time_e3 }}
		            		</button>
	                    </div>
						<div class="direction" v-if="seen === 0">
	                        <p>Chọn thời gian khám</p>
	                        <img src="./../../assets/icon_direction.png">
	                    </div>
	                    <div v-if="seen === 1">
	                    	<p class="selected_frame">Bạn đã chọn khung <span>{{ time_s1 }} - {{ time_e1 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num">{{sokb_frame1}}</p>
		                    <button class="btn btn-primary dangky" type="submit" @click="submit_button(id_frame1, sokb_frame1)">Đăng ký lấy số</button>
	                    </div>
	                    <div v-if="seen === 2">
	                    	<p class="selected_frame">Bạn đã chọn khung <span>{{ time_s2 }} - {{ time_e2 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num">{{sokb_frame2}}</p>
		                    <button class="btn btn-primary dangky" type="submit" @click="submit_button(id_frame2, sokb_frame2)">Đăng ký lấy số</button>
	                    </div>
	                    <div v-if="seen === 3">
	                    	<p class="selected_frame">Bạn đã chọn khung <span>{{ time_s3 }} - {{ time_e3 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num">{{sokb_frame3}}</p>
		                    <button class="btn btn-primary dangky" type="submit" @click="submit_button(id_frame3, sokb_frame3)">Đăng ký lấy số</button>
	                    </div> 
		            </div>
		        </div>
		    </section>
		    <section class="showNumKB" v-for="num in showNumber">
	            <div class="container">
	                <div class="row no_border" >
	                    <h4>Thông tin đã đăng kí số khám bệnh</h4>
	                    <div class="box_info" >
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Họ và tên:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.tenbn }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Số khám bệnh:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.sokb }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Thời gian lấy số:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.thoigian }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Khung giờ khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ time_start }} - {{ time_end }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Thời gian dự kiến khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ timeExpected }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Tại phòng khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.tencs }}</p>
	                            </div>
	                        </div>
	                        <div class="row row_end">
	                            <div class="col m4 s4">
	                                <p>Địa chỉ hành nghề:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.diachi }}</p>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>
	    	<section class="info_phongkham" >
		        <div class="container">
		            <div class="row no_border">
		                <h4>Thông tin phòng khám</h4>
		                <div class="box_info" v-for="inf in infor">
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
							<div class="row row_end" >
								<div class="col m3 s6">
									<p>Thời gian khám trung bình (đv: Phút)</p>
								</div>
								<div class="col m9 s6">
									<p>{{ inf.timetb }}</p>
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
		        </div>
		    </section>
    	</section>
    	<section v-for="inf in infor" v-if="inf.layout ===2">
    		<section class="takeNumber2" >
	    		<div class="container">
		            <div class="row">
		            	<div class="radio_time">
		            		<button class="btn" v-if="time_s1" v-on:click="seen = 1" @click="showNum(id_frame1, sokb_frame1)">
		            			{{ time_s1 }} - {{ time_e1 }}
		            		</button>
		            		<button class="btn" v-if="time_s2 !== '00:00'" v-on:click="seen = 2" @click="showNum(id_frame2, sokb_frame2)">
		            			{{ time_s2 }} - {{ time_e2 }}
		            		</button>
		            		<button class="btn" v-if="time_s3 !== '00:00'" v-on:click="seen = 3" @click="showNum(id_frame3, sokb_frame3)">
		            			{{ time_s3 }} - {{ time_e3 }}
		            		</button>
	                    </div>
						<div class="direction2" v-if="seen === 0">
	                        <p>Chọn thời gian khám</p>
	                        <img src="./../../assets/icon_direction.png">
	                    </div>
	                    <div v-if="seen === 1">
	                    	<p class="selected_frame2">Bạn đã chọn khung <span>{{ time_s1 }} - {{ time_e1 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num2">{{sokb_frame1}}</p>
		                    <button class="btn btn-primary dangky2" type="submit" @click="submit_button(id_frame1, sokb_frame1)">Đăng ký lấy số</button>
	                    </div>
	                    <div v-if="seen === 2">
	                    	<p class="selected_frame2">Bạn đã chọn khung <span>{{ time_s2 }} - {{ time_e2 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num2">{{sokb_frame2}}</p>
		                    <button class="btn btn-primary dangky2" type="submit" @click="submit_button(id_frame2, sokb_frame2)">Đăng ký lấy số</button>
	                    </div>
	                    <div v-if="seen === 3">
	                    	<p class="selected_frame2">Bạn đã chọn khung <span>{{ time_s3 }} - {{ time_e3 }}</span> để lấy số</p>
		                    <p id="numberKB" class="num2">{{sokb_frame3}}</p>
		                    <button class="btn btn-primary dangky2" type="submit" @click="submit_button(id_frame3, sokb_frame3)">Đăng ký lấy số</button>
	                    </div> 
		            </div>
		        </div>
		    </section>
		    <section class="showNumKB2" v-for="num in showNumber">
	            <div class="container">
	                <div class="row no_border" >
	                    <h4>Thông tin đã đăng kí số khám bệnh</h4>
	                    <div class="box_info" >
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Họ và tên:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.tenbn }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Số khám bệnh:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.sokb }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Thời gian lấy số:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.thoigian }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Khung giờ khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ time_start }} - {{ time_end }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Thời gian dự kiến khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ timeExpected }}</p>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col m4 s4">
	                                <p>Tại phòng khám:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.tencs }}</p>
	                            </div>
	                        </div>
	                        <div class="row row_end">
	                            <div class="col m4 s4">
	                                <p>Địa chỉ hành nghề:</p>
	                            </div>
	                            <div class="col m8 s8">
	                                <p>{{ num.diachi }}</p>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </section>
	    	<section class="info_phongkham2" >
		        <div class="container">
		            <div class="row no_border">
		                <h4>Thông tin phòng khám</h4>
		                <div class="box_info" v-for="inf in infor">
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
							<div class="row row_end" >
								<div class="col m3 s6">
									<p>Thời gian khám trung bình (đv: Phút)</p>
								</div>
								<div class="col m9 s6">
									<p>{{ inf.timetb }}</p>
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
		        </div>
		    </section>
    	</section>
    </section>
</template>
<script>
export default{
	data(){
		return{
			infor:null,
			time_s1:null,
			time_s2:null,
			time_s3:null,
			time_e1:null,
			time_e2:null,
			time_e3:null,
			id_frame1:'',
			id_frame2:'',
			id_frame3:'',
			seen: 0,
			id_benhnhan:'',
			checkThongtinU:'',
			status:'',
			checkDangki:'',
			checkQuakhung:'',
			sokb_frame1:'',
			sokb_frame2:'',
			sokb_frame3:'',
			showNumber:'',
			time_start:'',
			time_end:'',
			timetb:'',
			timeExpected:'',
		}
	},
	created(){
      this.info()
    },
    updated(){
    	// this.showNum()
    },
	methods:{
		info(){
			this.axios
			.post('/hosopk', {idpk:this.$route.params.idpk})
       		.then(response => {
       			this.infor		=response.data.info
       			this.time_s1	=response.data.time_s1
       			this.time_s2	=response.data.time_s2
       			this.time_s3	=response.data.time_s3
       			this.time_e1	=response.data.time_e1
       			this.time_e2	=response.data.time_e2
       			this.time_e3	=response.data.time_e3
       			this.id_frame1	=response.data.id_frame1
       			this.id_frame2	=response.data.id_frame2
       			this.id_frame3	=response.data.id_frame3
       			this.sokb_frame1=response.data.sokb_frame1
       			this.sokb_frame2=response.data.sokb_frame2
       			this.sokb_frame3=response.data.sokb_frame3
       		})
       		.catch(e => {this.errors.push(e)
       		})
		},
		submit_button(id_frame, sokb_frame){
			this.axios
			.post('/dangkylayso', {
				idpk:this.$route.params.idpk,
				idkhung: id_frame,
				sokb: sokb_frame,
			})
       		.then(response => { 
				// console.log(response.data)
				this.id_benhnhan = response.data.id_benhnhan;
				// Kiểm tra đã đăng nhập chưa
				if (this.id_benhnhan === null){
					alert('Bạn vui lòng đăng nhập!');
					this.$router.push({path: '/login'});
				}
				else{
					this.checkThongtinU = response.data.checkThongtinU;
					// Đã đăng nhập thì kiểm tra đã có thông tin chưa
					if(this.checkThongtinU === 'unexist'){
						alert('Bạn chưa có đăng kí thông tin!!!');
						this.$router.push({path: '/luu-hoso-benh-nhan'});
					}
					else{
						this.status = response.data.status;
						this.checkDangki = response.data.checkDangki;
						this.checkQuakhung = response.data.checkQuakhung;
						if(this.status ==='success'){
							alert('Đăng kí thành công');
						}
						if(this.checkDangki ==='is'){
							alert('Đã đăng ký lấy số khám bệnh');
						}
						if(this.checkQuakhung ==='is'){
							alert('Đã hết thời gian đăng kí khám bệnh!');
						}
					}
				}
			})
			.catch(error => {
			    console.log(error.response)
			});
		},
		showNum(id_frame, sokb_frame){
			this.axios
			.post('/show_NumKB', {
				idpk:this.$route.params.idpk,
				idkhung: id_frame,
				sokb: sokb_frame,
			})
			.then(response=>{
				this.showNumber 	= response.data.showNumber
				this.time_start 	= response.data.time_start
				this.time_end 		= response.data.time_end
				this.timetb 		= response.data.timetb
				this.timeExpected 	= response.data.timeExpected
			})
			.catch(error =>{

			})
		}
	},
}
</script>