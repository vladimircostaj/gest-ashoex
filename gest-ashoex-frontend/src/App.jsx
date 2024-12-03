import { useState } from "react";
import HealthCheck from "./components/health/health.jsx";
import "./App.css";
import Header from "./components/common/header.jsx";
import SlideBar from "./components/common/slidebar.jsx";

import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import RegistrarAmbiente from "./pages/Ambiente/registrar_ambiente_page.jsx";
import ListaAmbientes from "./pages/Ambiente/listar_ambientes_page.jsx";
import RegistrarPersonal from "./pages/Personal/registrar_personal.jsx";
import EditarAmbiente from "./pages/Ambiente/editar_ambiente_page.jsx";
import RegistrarMateriaForm from "./pages/Curricula/registrar_materia_page.jsx";
import AgregarCarreraPage from "./pages/Curricula/agregar_carrera_page.jsx";
import AgregarCurriculaPage from "./pages/Curricula/agregar_curricula.jsx";
import ListaCurriculas from "./pages/Curricula/listarCurricula.jsx";
import ListarMaterias from "./pages/Curricula/listar_materia.jsx";
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
        <Route path="/" element={<HealthCheck />}>
          <Route path="/registrar-ambiente" element={<RegistrarAmbiente />} />
          <Route path="/lista-ambientes" element={<ListaAmbientes />} />
          <Route path="/registrar-personal" element={<RegistrarPersonal />} />
          <Route
            path="/editar-ambiente/:ambienteId"
            element={<EditarAmbiente />}
          />
        </Route>
        <Route path="/registrar-materia" element={<RegistrarMateriaForm />} />
        <Route path="/registrar-carrera" element={<AgregarCarreraPage />} />
        <Route path="/registrar-curricula" element={<AgregarCurriculaPage />} />
        <Route path="/listar-curriculas" element={<ListaCurriculas />} />
        <Route path="/listar-materias" element={<ListarMaterias />} />

      </Routes> 
    </Router>
  );
}

export default App;
