import { Calendar, Clock, MapPin, Users } from "lucide-react";
import { Link } from "react-router-dom";
import { useState } from "react";

const EventDetail = () => {
  const [showEmailInput, setShowEmailInput] = useState(false);
  const [email, setEmail] = useState("");
  const [activeTab, setActiveTab] = useState("overview");

  const handleRegisterClick = () => {
    setShowEmailInput(true);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Email submitted:", email);
    setShowEmailInput(false);
  };

  return (
    <div className="px-4 sm:px-8 md:px-12 py-6 sm:py-8 mt-16 sm:mt-20">
      {/* Breadcrumb Navigation */}
      <div className="flex items-center gap-2 text-sm text-gray-600 mb-4 sm:mb-6 overflow-x-auto pb-2">
        <Link to="/" className="hover:text-gray-900 whitespace-nowrap">
          Home
        </Link>
        <span>/</span>
        <Link to="/events" className="hover:text-gray-900 whitespace-nowrap">
          Events
        </Link>
        <span>/</span>
        <span className="font-bold text-[#343434] whitespace-nowrap">Open Source on The School</span>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
        {/* Left Column - Image */}
        <div className="col-span-1 space-y-6 lg:border-r-2 lg:border-gray-400 lg:pr-6">
          <div className="w-full h-48 sm:h-56 bg-[#343434] rounded-lg mb-4 sm:mb-7"></div>

          {/* Event Info Cards */}
          <div className="space-y-4 sm:space-y-6 mx-2 sm:mx-8 md:mx-12 text-[#343434]">
            <div className="flex items-center gap-3">
              <Calendar className="w-5 h-5 flex-shrink-0" />
              <span className="text-sm sm:text-base">
                <span className="font-semibold">Sunday 21 - Tuesday 24</span> October 2024
              </span>
            </div>

            <div className="flex items-center gap-3">
              <Clock className="w-5 h-5 flex-shrink-0" />
              <span className="font-semibold text-sm sm:text-base">08:00 - 12.00</span>
            </div>

            <div className="flex items-center gap-3">
              <MapPin className="w-5 h-5 flex-shrink-0" />
              <span className="font-semibold text-sm sm:text-base">UDINUS H6</span>
            </div>

            <div className="flex items-center gap-3">
              <Users className="w-5 h-5 flex-shrink-0" />
              <span className="text-sm sm:text-base">
                <span className="font-semibold">50</span> Participant
              </span>
            </div>
          </div>

          {/* Email Input */}
          {showEmailInput && (
            <form onSubmit={handleSubmit} className="space-y-4 mt-6">
              <input
                type="email"
                className="w-full p-2 border border-gray-300 rounded-lg"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
              <button
                type="submit"
                className="w-full bg-[#343434] text-white py-2 sm:py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors font-semibold cursor-pointer"
              >
                Notify Me!
              </button>

              <div className="text-center">
                <span className="text-[#343434] text-sm sm:text-base font-bold">
                  <span className="text-gray-500 font-semibold">Registration Opens in</span> 5 days!
                </span>
              </div>
            </form>
          )}

          {/* Register Button */}
          {!showEmailInput && (
            <button
              className="w-full bg-[#343434] text-white py-2 sm:py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors cursor-pointer mt-6"
              onClick={handleRegisterClick}
            >
              Register
            </button>
          )}
        </div>

        {/* Right Column - Event Details */}
        <div className="col-span-1 lg:col-span-2 space-y-4 mt-6 lg:mt-0">
          <div className="flex flex-wrap gap-2 mb-4">
            <span className="px-3 py-1 bg-[#343434] text-white text-xs sm:text-sm rounded-lg">
              RKT
            </span>
            <span className="px-3 py-1 bg-[#343434] text-white text-xs sm:text-sm rounded-lg">
              Programming
            </span>
          </div>

          <h1 className="text-xl sm:text-2xl text-[#343434] font-bold mb-4 sm:mb-6">Open Source on The School</h1>

          {/* Tabs Navigation */}
          <div className="flex border-2 rounded-lg border-gray-500 overflow-hidden w-max">
            <button
              className={`mx-1 my-1 py-1 sm:py-2 px-4 sm:px-6 text-xs sm:text-sm rounded-lg transition-colors cursor-pointer ${
                activeTab === "overview"
                  ? "bg-[#343434] text-white"
                  : "bg-white text-[#343434]"
              }`}
              onClick={() => setActiveTab("overview")}
            >
              Overview
            </button>
            <button
              className={`mx-1 my-1 py-1 sm:py-2 px-4 sm:px-6 text-xs sm:text-sm rounded-lg transition-colors cursor-pointer ${
                activeTab === "speakers"
                  ? "bg-[#343434] text-white"
                  : "bg-white text-[#343434]"
              }`}
              onClick={() => setActiveTab("speakers")}
            >
              Speakers
            </button>
          </div>

          {/* Tabs Content */}
          <div className="space-y-3 sm:space-y-4 text-[#000000] mt-4 text-sm sm:text-base">
            {activeTab === "overview" && (
              <>
                <p>Hallo Doscomers!!!</p>
                <p>
                  Tahun ini, OOTS hadir lebih spesial karena diselenggarakan bersamaan dengan FIK FAIR! Jangan lewatkan kesempatan seru dan
                  berkesan ini di Universitas Dian Nuswantoro. Dapatkan ilmu dan pengalaman dari pemateri-pemateri keren yang siap menginspirasi
                  kalian. Dijamin, tahun ini lebih seru daripada sebelumnya!
                </p>
                <p>Pemateri dan materi yang akan dibawakan:</p>
              </>
            )}

            {activeTab === "speakers" && (
              <>
                <h2 className="text-lg sm:text-xl font-bold">Speakers</h2>
                <p>- Wildan - "Tailwind"</p>
                <p>- Sulthan - "Git"</p>
                <p>- Pemateri lainnya akan segera diumumkan...</p>
              </>
            )}
          </div>

          {/* Contact Information */}
          <div className="mt-6">
            <p className="mb-2 text-sm sm:text-base">Informasi lebih lanjut :</p>
            <p className="text-sm sm:text-base"> +62 899-5873-658 (wildan)</p>
            <p className="text-sm sm:text-base"> +62 877-0031-3085 (sulthan)</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default EventDetail;