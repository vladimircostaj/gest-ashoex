import { BsBuildingFillCheck, BsHouseCheckFill } from "react-icons/bs";

export const sideMenuOptions = [
  {
    name: "Edificios",
    path: "/edificios",
    icon: <BsBuildingFillCheck />, // Puedes usar iconos de tu elección
    subOptions: [
      { name: "Registrar edificio", path: "registrar-edificio" },
      { name: "Ver edificios", path: "ver-edificios" },
      { name: "Editar edificio", path: "editar-edificio" },
      { name: "Eliminar edificio", path: "eliminar-edificio" },
    ],
  },
  {
    name: "Ambientes",
    path: "/ambientes",
    icon: <BsHouseCheckFill />, // Puedes usar iconos de tu elección
    subOptions: [
      { name: "Registrar ambiente", path: "registrar-ambiente" },
      { name: "Ver ambientes", path: "ver-ambientes" },
      { name: "Editar ambiente", path: "editar-ambiente" },
      { name: "Eliminar ambiente", path: "eliminar-ambiente" },
    ],
  },
  {
    name: "Facilidad",
    path: "facilidad",
    icon: <BsHouseCheckFill />,
    subOptions: [
      { name: "Registrar facilidad", path: "registrar-facilidad" },
      { name: "Ver facilidades", path: "ver-facilidades" },
      { name: "Editar facilidad", path: "editar-facilidad" },
      { name: "Eliminar facilidad", path: "eliminar-facilidad" },
    ],
  },
];
