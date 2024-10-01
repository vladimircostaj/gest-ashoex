import { useState } from 'react'
import HealthCheck from './components/health/health.jsx'
import ListaCarreras from './components/carreras/ListaCarreras.jsx'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import './App.css'

function App() {

  return (
    <>
    <BrowserRouter>
       <Routes>
          <Route path="/" element={<HealthCheck />} />
          <Route path="/carreras" element={<ListaCarreras />} />
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
