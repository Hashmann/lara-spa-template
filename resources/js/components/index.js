import Clock from "./ui/Clock.vue";
import LanguageSwitcher from './ui/LanguageSwitcher.vue'
import ThemeSwitcher from './ui/ThemeSwitcher.vue'

import AdminBar from './admin/AdminBar.vue'
import AdminDrawer from "./admin/AdminDrawer.vue";
import ShowUserTabs from './admin/ShowUserTabs.vue'

import Rules from './auth/Rules.vue'

import UserBar from './main/UserBar.vue'
import UserDrawer from './main/UserDrawer.vue'

//INFO CHART
import BarChart from './ui/chart/Bar.vue'
import RadarChart from './ui/chart/Radar.vue'
import LineChart from './ui/chart/Line.vue'
//INFO END CHART

export default [
  Clock,
  AdminBar,
  AdminDrawer,
  BarChart,
  RadarChart,
  LineChart,
  Rules,
  LanguageSwitcher,
  ShowUserTabs,
  ThemeSwitcher,
  UserBar,
  UserDrawer
]
