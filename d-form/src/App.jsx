// File: src/App.jsx
import { BrowserRouter as Router } from "react-router-dom";
import AppRoutes from "./routes/index";
import { AuthProvider } from "./admin/components/layout/AuthContext";


function App() {
  return (
    
    <AuthProvider>
      <Router>
        <AppRoutes />
      </Router>
    </AuthProvider>
  );
}

export default App;