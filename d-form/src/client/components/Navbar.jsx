import { Link, useLocation } from 'react-router-dom';
import { useState } from 'react';
import { Menu, X } from 'lucide-react'; // Assuming you're using lucide-react for icons

const Navbar = () => {
  const location = useLocation();
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const getLinkClass = (path) =>
    location.pathname === path ||
    (path === '/events' && location.pathname.startsWith('/events'))
      ? 'text-[#343434] font-semibold'
      : 'text-gray-600 hover:text-black';

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  return (
    <nav className="fixed top-0 left-0 right-0 flex items-center justify-between p-3 sm:p-4 md:p-5 bg-white shadow-md z-50">
      <div className="text-[#343434] flex items-center">
        <div className="text-4xl sm:text-5xl font-bold pl-2 sm:pl-4 md:pl-7">
          D
        </div>
        <div className="text-3xl sm:text-4xl pl-2"> FORM</div>
        {/* Desktop menu */}
        <div className="hidden md:flex space-x-6 lg:space-x-10 pr-4 lg:pl-20">
          <Link className={`text-lg ${getLinkClass('/')}`} to="/">
            Home
          </Link>
          <Link className={`text-lg ${getLinkClass('/events')}`} to="/events">
            Events
          </Link>
          <Link className={`text-lg ${getLinkClass('/about')}`} to="/about">
            About
          </Link>
        </div>
      </div>

      {/* Mobile menu button */}
      <div className="md:hidden pr-2 sm:pr-4">
        <button onClick={toggleMenu} className="p-2 cursor-pointer">
          {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
        </button>
      </div>

      {/* Mobile menu dropdown */}
      {isMenuOpen && (
        <div className="absolute top-full left-0 right-0 bg-white shadow-md md:hidden py-4">
          <div className="flex flex-col items-center space-y-4">
            <Link
              className={`text-lg ${getLinkClass('/')}`}
              to="/"
              onClick={() => setIsMenuOpen(false)}
            >
              Home
            </Link>
            <Link
              className={`text-lg ${getLinkClass('/events')}`}
              to="/events"
              onClick={() => setIsMenuOpen(false)}
            >
              Events
            </Link>
            <Link
              className={`text-lg ${getLinkClass('/about')}`}
              to="/about"
              onClick={() => setIsMenuOpen(false)}
            >
              About
            </Link>
          </div>
        </div>
      )}
    </nav>
  );
};

export default Navbar;
