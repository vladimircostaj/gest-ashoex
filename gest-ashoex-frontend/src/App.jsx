import { useState } from 'react'
import HealthCheck from './components/health/health.jsx'
import './App.css'
import CarrerasTable from './components/tablaCarreras.jsx'
function App() {

  return (
    <>
    <HealthCheck />
    <CarrerasTable/>
    </>
  )
}

export default App
