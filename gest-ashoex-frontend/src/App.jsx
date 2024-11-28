import { useState } from "react";
import HealthCheck from "./components/health/health.jsx";
import "./App.css";
import Header from "./components/common/header.jsx";
import SlideBar from "./components/common/slidebar.jsx";

import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import RegistrarAmbiente from "./pages/Ambiente/registrar_ambiente_page.jsx";
import ListaAmbientes from "./pages/Ambiente/listar_ambientes_page.jsx";
function App() {
  const [isSliderOpen, setIsSliderOpen] = useState(false);
  const toggleSlider = () => setIsSliderOpen((prevState) => !prevState);
  return (
    <Router>
      <Header toggleSlider={toggleSlider} />
      {isSliderOpen && (
        <SlideBar isOpen={isSliderOpen} toggleSlider={toggleSlider} />
      )}

      <Routes>
        <Route path="/" element={<HealthCheck />} />
        <Route path="/registrar-ambiente" element={<RegistrarAmbiente />} />
        <Route path="/lista-ambientes" element={<ListaAmbientes />} />
      </Routes>
    </Router>
  );
}

export default App;
