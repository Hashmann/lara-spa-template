<template>
  <Radar
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
import {Radar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, PointElement, RadialLinearScale, LineElement,} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, PointElement, RadialLinearScale, LineElement)
export default {
  name: "RadarChart",
  components: {Radar},
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
      labels: [
        'Маршрут',
        'Тур-лидер',
        'Проживание',
        'Транспорт',
        'Цена/качество',
      ],
      datasets: [
        {
          label: 'Тур 1',
          fill: true,
          backgroundColor: 'rgba(179,181,198,0.2)',
          borderColor: 'rgba(179,181,198,1)',
          pointBackgroundColor: 'rgba(179,181,198,1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(179,181,198,1)',
          data: [4.5, 2, 3, 1, 5]
        },
        {
          label: 'Тур 2',
          fill: true,
          backgroundColor: 'rgba(255,99,132,0.2)',
          borderColor: 'rgba(255,99,132,1)',
          pointBackgroundColor: 'rgba(255,99,132,1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(255,99,132,1)',
          data: [2, 3, 5, 5, 3.5]
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
          suggestedMax: 5
        }
      },
      elements: {
        line: {
          borderWidth: 1
        }
      }
    }

  }),
  mounted() {
    console.log("mounted RadarChart")
  },
  unmounted() {
    console.log("unmounted RadarChart")
  },
}
</script>

<style scoped>

</style>
