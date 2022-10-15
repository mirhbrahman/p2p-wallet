import React, { useEffect, useState } from "react";
import { getRoutes } from "./routes";
import Router from "./routes/Router";

import "bootstrap/dist/css/bootstrap.min.css";
import "react-toastify/dist/ReactToastify.css";
import "./App.css";
import useAuthCheck from "./hooks/authCheck";

function App() {
  const isAuth = useAuthCheck();
  const [allRoutes, setAllRoutes] = useState([]);

  useEffect(() => {
    const routes = getRoutes();
    setAllRoutes([...allRoutes, routes]);
  }, []);

  return <Router allRoutes={allRoutes} />;
}

export default App;
