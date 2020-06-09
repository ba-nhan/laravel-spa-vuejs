import VueRouter from 'vue-router'

// Pages
import Home               from './pages/Home'
import HomeFilter         from './pages/HomeFilter'
import Register           from './pages/Register'
import Login              from './pages/Login'
import Search             from './pages/Search'

import Benhnhan           from './pages/benhnhan/Hoanthanhhoso'
import BenhnhanHome       from './pages/benhnhan/Home'
import Lichsukbbn         from './pages/benhnhan/LichsuKhambenh'

import Bacsi              from './pages/bacsi/Hoanthanhhoso'
import BacsiHome          from './pages/bacsi/Home'
import Phongkham          from './pages/phongkham/Index'
import Dangtin            from './pages/bacsi/Dangtin'
import Tintuc             from './pages/bacsi/Tintuc'
import Danhsachkhambenh   from './pages/bacsi/Danhsachkhambenh'
import Ketquakhambenh     from './pages/bacsi/KetquaKhambenh'
import LichsuKhambenh     from './pages/bacsi/LichsuKhambenh'
import LoclichsuKhambenh  from './pages/bacsi/LoclichsuKhambenh'

import Bangtin            from './pages/phongkham/Bangtin'

// Routes
const routes = [
  {
    path: '/loc-theo-chuyen-khoa/:id',
    name: 'homefilter',
    component: HomeFilter,
    meta: {
      auth: undefined,
      title: 'Lọc phòng khám theo chuyên khoa'
    }
  },
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined,
      title: 'Trang chủ'
    }
  },
  {
    path: '/tim-kiem',
    name: 'search',
    component: Search,
    meta: {
      auth: undefined,
      title: 'Tìm kiếm'
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false,
      title: 'Đăng kí thành viên'
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false,
      title: 'Đăng nhập'
    }
  },
  //Bệnh nhân
  {
    path: '/luu-hoso-benh-nhan',
    name: 'bn',
    component: Benhnhan,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lưu hồ sơ bệnh nhân'
      // handle redirection  : xử lý chuyển hướng
      // Dashboard           : bảng điều khiển
      // forbidden Redirect  : cấm chuyển hướng
    }
  },
  {
    path: '/lich-su-kham-benh',
    name: 'lichsukbbn',
    component: Lichsukbbn,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lịch sử khám bệnh'
    }
  },
  {
    path: '/thong-tin-benh-nhan',
    name: 'benhnhan',
    component: BenhnhanHome,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Thông tin bệnh nhân'
    }
  },
  //Bacsi
  {
    path: '/luu-hoso-bac-si',
    name: 'bs',
    component: Bacsi,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lưu hồ sơ bác sĩ'
    }
  },
  {
    path: '/bac-si',
    name: 'bacsi',
    component: BacsiHome,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Thông tin bác sĩ'
    }
  },
  {
    path: '/bac-si/danh-sach-kham-benh',
    name: 'danhsachkhambenh',
    component: Danhsachkhambenh,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Danh sách khám bệnh'
    }
  },
  {
    path: '/bac-si/dang-tin',
    name: 'dangtin',
    component: Dangtin,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Đăng tin'
    }
  },
  {
    path: '/bac-si/tin-tuc',
    name: 'tintuc',
    component: Tintuc,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Tin tức'
    }
  },
  {
    // :iddk tiềm ẩn rủi ro
    path: '/bac-si/luu-ket-qua-kham-benh/:iddk',
    // path: '/bac-si/luu-ket-qua-kham-benh/',
    name: 'luuketquakb',
    component: Ketquakhambenh,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lưu kết quả khám bệnh'
    }
  },
  {
    // :iddk tiềm ẩn rủi ro
    path: '/bac-si/lich-si-kham-benh-cua-benh-nhan/:iddk',
    // path: '/bac-si/lich-si-kham-benh/',
    name: 'lichsukb',
    component: LichsuKhambenh,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lịch sử khám bệnh'
    }
  },
  {
    // :iddk tiềm ẩn rủi ro
    path: '/bac-si/loc-lich-si-kham-benh-cua-benh-nhan/',
    // path: '/bac-si/lich-si-kham-benh/',
    name: 'loclichsukb',
    component: LoclichsuKhambenh,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title: 'Lọc lịch sử khám bệnh'
    }
  },

  //Phòng khám

  {
    path: '/phong-kham/:idpk',
    // path: '/phong-kham',
    name: 'phongkham',
    component: Phongkham,
    meta: {
      auth: undefined,
      title: 'Phòng khám'
    }
  },
  {
    path: '/bang-tin/:idpk',
    name: 'bangtin',
    component: Bangtin,
    meta: {
      auth: undefined,
      title: 'Bảng tin'
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
})