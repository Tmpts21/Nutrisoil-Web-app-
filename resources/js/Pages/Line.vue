<template>
  <Line
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :width="width"
    :height="height"
    :css-classes="cssClasses"

  />
</template>

<script>
import { Line } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale,
  Plugin
} from 'chart.js'

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale
)
export default {
  name: 'LineChart',
  components: { Line },
  props: {
    chartData : {} , 
    chartId: {
      type: String,
      default: 'line-chart'
    },
        width: {
      type: Number,
      default: 50
    },
    height: {
      type: Number,
      default: 50
    },
        cssClasses: {
      default: '',
      type: String
    },

  },
  data() {
    return {
      chartOptions: {
        responsive: true ,
          font: {size: 14 }
        }
    } 
  }
}
</script>