import React, { useState, useEffect } from "react";
import Layout from "../Layout";

import { apiVersion, formatDate } from "../../../functions/functions-general"; 
import { FaCalendarTimes, FaBullhorn, FaUsers, FaGlassCheers, FaBuilding } from "react-icons/fa";
import useQueryData from "../../../functions/custom-hooks/useQueryData";

// --- Avatar Component ---
const Avatar = ({ firstName = "", lastName = "" }) => {
  const fName = firstName ? firstName.charAt(0) : "";
  const lName = lastName ? lastName.charAt(0) : "";
  const initials = `${fName}${lName}`.toUpperCase();
  
  return (
    <div className="flex items-center justify-center rounded-full bg-[#b02256] text-white font-bold w-10 h-10 shrink-0 text-sm">
      {initials}
    </div>
  );
};

const Dashboard = () => {
  // --- DATA FETCHING ---
  const { data: memos, isLoading: loadingMemos } = useQueryData(
    `${apiVersion}/controllers/developers/memo/page.php?start=1`, 
    'post', 
    'dashboard-memos',
    { searchValue: "", filterData: "" } 
  );
  
const { data: employees, isLoading: loadingEmployees } = useQueryData(
    `${apiVersion}/controllers/developers/employees/read.php`, 
    'get', 
    'dashboard-employees-all'
  );

  // --- State for Dashboard Widgets ---
  const [celebrations, setCelebrations] = useState([]);
  const [newEmployees, setNewEmployees] = useState([]);
  const [webTeam, setWebTeam] = useState([]);

  // --- Process Employee Data ---
  useEffect(() => {
    // Safely access paginated data array
    const employeeList = employees?.data?.data || employees?.data;

    if (employeeList && Array.isArray(employeeList)) {
      const today = new Date();
      const currentMonth = today.getMonth();
      const currentDate = today.getDate();
      const currentYear = today.getFullYear();

      const todaysCelebrations = [];
      const thisMonthsHires = [];
      const webDevTeam = [];

      employeeList.forEach(emp => {
        // 1. My Team: Filter for "Web Development"
        const deptName = (emp.department_name || "").toLowerCase();
        if (deptName.includes('web') || deptName.includes('dev')) {
          webDevTeam.push(emp);
        }

        // 2. Check Birthdays (Strictly TODAY: matches month and day)
        if (emp.employee_birthday) {
          const bday = new Date(emp.employee_birthday);
          if (bday.getMonth() === currentMonth && bday.getDate() === currentDate) {
            todaysCelebrations.push({ ...emp, type: 'Birthday' });
          }
        }

        // 3. New Hires (THIS MONTH: matches month and year, ignores the specific day)
        if (emp.employee_start_work_date) {
          const startDate = new Date(emp.employee_start_work_date);
          if (
            startDate.getMonth() === currentMonth && 
            startDate.getFullYear() === currentYear
          ) {
            thisMonthsHires.push(emp);
          }
        }
      });

      setCelebrations(todaysCelebrations);
      setNewEmployees(thisMonthsHires);
      setWebTeam(webDevTeam);
    }
  }, [employees]);

  return (
    <Layout menu="dashboard">
      <div className="p-4 md:p-6 w-full text-gray-800">
        
        {/* PAGE HEADER */}
        <div className="mb-6 pb-4">
          <h1 className="text-xl font-bold">Welcome Mojica, Sebastian Jose!</h1>
        </div>

        {/* DASHBOARD GRID */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
          
          {/* ================= LEFT COLUMN ================= */}
          <div className="space-y-6 flex flex-col">
            
            {/* Who's Out (Static) */}
            <div className="bg-white rounded shadow-sm border border-gray-100">
              <div className="p-3 bg-gray-50 border-b flex items-center gap-2 text-[#b02256] font-bold text-sm">
                <FaCalendarTimes /> Who's Out
              </div>
              <div className="p-4">
                <h4 className="text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-wider">Today</h4>
                <div className="flex items-start gap-3 mb-4">
                  <Avatar firstName="Maribel" lastName="Bosinas" />
                  <div className="text-xs">
                    <p className="font-semibold">Bosinas, Maribel</p>
                    <p className="text-gray-500">Maternity Leave</p>
                    <p className="text-gray-500">Day(s): 74</p>
                  </div>
                </div>
                <div className="flex items-start gap-3 mb-6">
                  <Avatar firstName="Thea" lastName="Consignado" />
                  <div className="text-xs">
                    <p className="font-semibold">Consignado, Thea Lyzette</p>
                    <p className="text-gray-500">Vacation Leave</p>
                    <p className="text-gray-500">Day(s): 1</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Celebrations */}
            <div className="bg-white rounded shadow-sm border border-gray-100">
              <div className="p-3 bg-gray-50 border-b flex items-center gap-2 text-[#b02256] font-bold text-sm">
                <FaGlassCheers /> Celebrations
              </div>
              <div className="p-6 text-center text-gray-500 text-xs leading-relaxed">
                {celebrations.length > 0 ? (
                    <ul className="space-y-4 text-left">
                      {celebrations.map((cel, idx) => (
                        <li key={idx} className="flex items-center gap-3">
                          <Avatar firstName={cel.employee_first_name} lastName={cel.employee_last_name} />
                          <div>
                            <p className="font-semibold text-gray-800">{cel.employee_last_name}, {cel.employee_first_name}</p>
                            <p className="text-gray-500">{cel.type} Today!</p>
                          </div>
                        </li>
                      ))}
                    </ul>
                ) : (
                    <>
                        <FaGlassCheers className="mx-auto text-4xl mb-4 text-gray-300" />
                        <p>No celebration for today. However, we would like to express our sincere appreciation and gratitude for all the hard work of our employees.</p>
                    </>
                )}
              </div>
            </div>

            {/* Welcome to Frontline */}
            <div className="bg-white rounded shadow-sm border border-gray-100">
              <div className="p-3 bg-gray-50 border-b flex items-center gap-2 text-[#b02256] font-bold text-sm">
                <FaBuilding /> Welcome to Frontline Business Solutions Inc.
              </div>
              {/* Added fixed height and scrollbar here to match the others */}
              <div className="p-6 text-center text-gray-500 text-xs h-fit overflow-y-auto">
                {newEmployees.length > 0 ? (
                    <ul className="space-y-4 text-left">
                      {newEmployees.map((emp, idx) => (
                        <li key={idx} className="flex items-center gap-3">
                          <Avatar firstName={emp.employee_first_name} lastName={emp.employee_last_name} />
                          <div>
                            <p className="font-semibold text-gray-800">{emp.employee_last_name}, {emp.employee_first_name}</p>
                            <p className="text-gray-500">Started this month in {emp.department_name}</p>
                          </div>
                        </li>
                      ))}
                    </ul>
                ) : (
                    <p className="pt-4">No new employee this month.</p>
                )}
              </div>
            </div>

          </div>

          {/* ================= RIGHT COLUMN ================= */}
          <div className="lg:col-span-2 space-y-6">
            {/* Announcement */}
            <div className="bg-white rounded shadow-sm border border-gray-100">
              <div className="p-3 bg-gray-50 border-b flex items-center gap-2 text-[#b02256] font-bold text-sm">
                <FaBullhorn /> Announcement
              </div>
              <div className="p-6 space-y-8 text-xs text-gray-700 leading-relaxed h-[400px] overflow-y-auto">
                {loadingMemos ? (
                  <p>Loading announcements...</p>
                ) : (memos?.data?.data || memos?.data)?.length > 0 ? (
                  // 1. Create a copy of the array using [...] so we don't mutate the original cache
                  // 2. Sort by the memo_created timestamp in descending order (Newest first)
                  [...(memos?.data?.data || memos?.data)]
                    .sort((a, b) => new Date(b.memo_created) - new Date(a.memo_created))
                    .map((memo, idx) => {
                      // Split the memo text by new lines
                      const textLines = memo.memo_text ? memo.memo_text.split('\n') : [];
                      // The first line becomes the title
                      const title = textLines.length > 0 ? textLines[0] : "Untitled Memo";
                      // The rest of the array becomes the body text
                      const bodyText = textLines.slice(1).join('\n').trim();

                      return (
                        <div key={idx} className="flex items-start gap-4">
                          <FaBullhorn className="text-gray-600 mt-1 shrink-0" size={16} />
                          <div>
                            {/* Bold Title from the first line */}
                            <h4 className="font-bold text-sm mb-1">{title}</h4>
                            <p className="text-gray-400 mb-3">
                              Date: {memo.memo_date ? formatDate(memo.memo_date, "--", "short-date") : "N/A"}
                            </p>
                            {/* Memo Body */}
                            <p className="whitespace-pre-line">{bodyText}</p>
                          </div>
                        </div>
                      );
                    })
                ) : (
                  <p>No announcements posted yet.</p>
                )}
              </div>
            </div>

            {/* My Team (Web Development Department Only) */}
            <div className="bg-white rounded shadow-sm border border-gray-100">
              <div className="p-3 bg-gray-50 border-b flex items-center gap-2 text-[#b02256] font-bold text-sm">
                <FaUsers /> My Team 
              </div>
              <div className="p-6">
                {webTeam.length > 0 ? (
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {webTeam.map((emp, idx) => (
                      <div key={idx} className="flex items-center gap-3">
                        <Avatar firstName={emp.employee_first_name} lastName={emp.employee_last_name} />
                        <div className="text-xs">
                          <p className="font-semibold text-gray-800">{emp.employee_last_name}, {emp.employee_first_name}</p>
                          <p className="text-gray-500">{emp.department_name}</p>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <p className="text-xs text-gray-500">No employees found in the Web Development department.</p>
                )}
              </div>
            </div>

          </div>

        </div>
      </div>
    </Layout>
  );
};

export default Dashboard;