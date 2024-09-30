import { createBrowserRouter } from "react-router-dom";

import App from "../App.jsx";
import SideMenu from "../components/Sidebar/sidebar.jsx";
import Facilidad from "../pages/Facilidad/facilidad.jsx";

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
    ],
  },

  {
    path: "/*",
    element: <div>Not Found</div>,
  },
]);

export default router;
