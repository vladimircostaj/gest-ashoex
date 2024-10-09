import { createBrowserRouter } from "react-router-dom";

import App from "../App.jsx";
import SideMenu from "../components/Sidebar/sidebar.jsx";
import Facilidad from "../pages/Facilidad/facilidad.jsx";
import RegistrarEdificio from "../components/registrar_edificio/registrar_edificio.jsx";
import VisualizarEdificios from "../components/visualizar_edificios/VisualizarEdificios.jsx";

const router = createBrowserRouter([
  {
    element: <App />,
    path: "/",
  },

  {
    path: "inicio",
    element: <SideMenu />,
    children: [
      {
        element: <Facilidad />,
        path: "registrar-facilidad",
      },
      {
        element: <RegistrarEdificio />,
        path: "registrar-edificio",
      },
      {
        element: <VisualizarEdificios />,
        path: "ver-edificios",
      }
    ],
  },

  {
    path: "/*",
    element: <div>Not Found</div>,
  },
]);

export default router;
