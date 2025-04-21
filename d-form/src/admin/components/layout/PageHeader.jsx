import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import { events } from '../../data/events'; // Corrected import path

function PageHeader() {
    const location = useLocation();
    const pathnames = location.pathname.split('/').filter(x => x);

    const getEventTitle = (id) => {
        const event = events.find(event => event.id.toString() === id);
        return event ? event.title : id;
    };

    return (
        <div className="px-8 py-6 fixed w-[calc(100%-15rem)] left-60 bg-white z-10">
            <div className="flex items-center">
                <Link to="/admin/dashboard" className="text-gray-500"></Link>
                {pathnames.map((name, index) => {
                    const routeTo = `/${pathnames.slice(0, index + 1).join('/')}`;
                    const isLast = index === pathnames.length - 1;
                    const displayName = name.match(/^\d+$/) ? getEventTitle(name) : name.charAt(0).toUpperCase() + name.slice(1); 
                    return isLast ? (
                        <span key={name} className="ml-2 font-semibold text-gray-700">{displayName}</span>
                    ) : (
                        <Link key={name} to={routeTo} className="ml-2 text-gray-500">{displayName} /</Link>
                    );
                })}
            </div>
        </div>
    );
}

export default PageHeader;