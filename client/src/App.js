import React, { useEffect, useState } from "react";
import { PublicRoute } from "./routes/PublicRoute";
import { getRoutes } from "./routes";
import Router from "./routes/Router";

import "bootstrap/dist/css/bootstrap.min.css";
import "react-toastify/dist/ReactToastify.css";
import "./App.css";


function App() {
  const [allRoutes, setAllRoutes] = useState([]);

  useEffect(() => {
    const routes = getRoutes();
    setAllRoutes([...allRoutes, routes]);
  }, []);

  return <Router allRoutes={allRoutes} />;
}

export default App;
