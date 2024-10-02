import { Link, Outlet, useLocation } from "react-router-dom";
import { sideMenuOptions } from "../../lib/constants";
import "./sidemenu.css";
import { useState } from "react"; // Importa useState

const SideMenu = () => {
  const { pathname } = useLocation();
  const [openSubMenu, setOpenSubMenu] = useState(null); // Estado para el submenú abierto

  const handleToggleSubMenu = (path) => {
    setOpenSubMenu(openSubMenu === path ? null : path); // Alterna el estado del submenú
  };

  return (
    <div className="sidemenu__container">
      <aside className="sidemenu">
        {/* LOGO */}
        <div className="sidemenu__logo">
          {/* <img src="" alt="Ambiente" /> */}
          <div>
            <h1 className="sidemenu__title">Reserva de ambientes</h1>
          </div>
        </div>

        {/* SIDE MENU OPTIONS */}
        <ul className="sidemenu__list">
          {sideMenuOptions.map((option) => (
            <li key={option.path}>
              {option.subOptions ? (
                <div
                  className={`sidemenu__link ${
                    pathname.includes(option.path) && "sidemenu__link--active"
                  }`}
                  onClick={() => handleToggleSubMenu(option.path)} // Alterna el submenú
                >
                  <span>{option.icon}</span>
                  {option.name}
                </div>
              ) : (
                <Link
                  to={{ pathname: option.path }}
                  className={`sidemenu__link ${
                    pathname.includes(option.path) && "sidemenu__link--active"
                  }`}
                >
                  <span>{option.icon}</span>
                  {option.name}
                </Link>
              )}

              {/* Submenú */}
              {option.subOptions && openSubMenu === option.path && (
                <ul className="sidemenu__sublist">
                  {option.subOptions.map((subOption) => (
                    <li key={subOption.path}>
                      <Link
                        to={{ pathname: subOption.path }}
                        className={`sidemenu__sublink ${
                          pathname.includes(subOption.path) &&
                          "sidemenu__link--active"
                        }`}
                      >
                        {subOption.name}
                      </Link>
                    </li>
                  ))}
                </ul>
              )}
            </li>
          ))}
        </ul>
      </aside>
      <Outlet />
    </div>
  );
};

export default SideMenu;
