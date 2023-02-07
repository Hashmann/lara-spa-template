<template>
  <Line
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
</template>

<script>
import {Line} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale)
export default {
  name: "LineChart",
  components: {Line},
  props: {
    chartId: {
      type: String,
      default: 'radar-chart'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {
      }
    },
    plugins: {
      type: Array,
      default: () => []
    }
  },
  data: () => ({
    chartData: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label: 'My First Dataset',
          data: [65, 59, 80, 81, 56, 55, 40],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }
      ]
    },
    chartOptions: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        r: {
          angleLines: {
            display: false
          },
          suggestedMin: 0,
          suggestedMax: 100
        }
      },
      elements: {
        line: {
          borderWidth: 1
        }
      },
      plugins: {
        legend: {
          display: true,
          labels: {
            color: 'rgb(255, 99, 132)'
          }
        }
      }
    }

  }),
  mounted() {
    console.log("mounted LineChart")
  },
  unmounted() {
    console.log("unmounted LineChart")
  },
}
</script>

<style scoped>

</style>
