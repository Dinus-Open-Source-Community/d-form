import React from "react";
import { Link, useLocation } from "react-router-dom";
import MenuItem from "../navigation/MenuItem";
import UserInfo from "../common/UserInfo";
import { useAuth } from "./AuthContext";

function Sidebar() {
  const location = useLocation();
  const {user} = useAuth();

  return (
    <div className="fixed top-0 left-0 h-full w-60 bg-[#343434] text-white flex flex-col z-40">
      {/* Logo */}
      <div className="p-4 flex justify-center items-center">
        <h1 className="text-5xl font-bold">D</h1>
        <span className="ml-2 text-4xl">FORM</span>
      </div>

      {/* Tombol New Event */}
      <div className="p-6 flex justify-center">
        <button className="bg-white/10 text-white rounded-lg py-2 px-4 text-center">
          New Event
        </button>
      </div>

      {/* Menu Items */}
      <div className="flex-grow overflow-y-auto">
        <Link to="/admin/dashboard">
          <MenuItem
            icon="menu"
            text="Dashboard"
            active={location.pathname === "/admin/dashboard"}
          />
        </Link>
        
        <Link to="/admin/events">
          <MenuItem
            icon="menu"
            text="Events"
            active={location.pathname === "/admin/events"}
          />
        </Link>
      </div>

      {/* User Info */}
      <div className="mt-auto">
        <UserInfo username={user.name} email={user.email} />
      </div>
    </div>
  );
}

export default Sidebar;
