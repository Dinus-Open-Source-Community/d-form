import { Link, useLocation } from "react-router-dom";

const Navbar = () => {
    const location = useLocation();
    const getLinkClass = (path) => 
        location.pathname === path || (path === "/events" && location.pathname.startsWith("/events"))
            ? "text-[#343434] font-semibold"
            : "text-gray-600 hover:text-black";

    return (
        <nav className="flex items-center justify-between p-5 bg-white shadow-md">
            <div className="text-[#343434] flex items-center space-x-2">
                <div className="text-5xl font-bold pl-7">D</div>
                <div className="text-4xl pl-1"> FORM</div>
                <div className="space-x-10 pl-20">
                    <Link className={`text-1xl ${getLinkClass("/")}`} to="/">Home</Link>
                    <Link className={`text-1xl ${getLinkClass("/events")}`} to="/events">Events</Link>
                    <Link className={`text-1xl ${getLinkClass("/about")}`} to="/about">About</Link>
                </div>
            </div>
        </nav>
    );
};

export default Navbar;