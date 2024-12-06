// import "./App.css";
import React from "react";
import { BrowserRouter as Router, Route, Routes, Link, useLocation } from "react-router-dom";
import "./assets/css/style.css";
import Register from "./components/Register";
import Login from "./components/Login";
import Sidebar from "./components/Sidebar/Sidebar";

import Home from "./components/Home";
import MovieDetails from "./components/MovieDetails";

function App() {
  const location = useLocation();
  const showSidebar = location.pathname !== '/login' && location.pathname !== '/register';
  const showHome = location.pathname === '/';

  return (
      <div>
          <main>
          {showSidebar && <Sidebar />}

          {showHome && <Home />}
          <Routes>
                  <Route path="/register" element={<Register />} />
                  <Route path="/login" element={<Login />} />
                  <Route path="/movie/:id" element={<MovieDetails />} />
          </Routes>
          </main>
         
      </div>
  );
}

export default function WrappedApp() {
  return (
      <Router>
          <App />
      </Router>
  );
}
