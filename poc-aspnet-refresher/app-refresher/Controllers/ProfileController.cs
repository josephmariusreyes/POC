using Microsoft.AspNetCore.Mvc;
using app_refresher.Models;
using app_refresher.Services;
using app_refresher.ViewModels;

namespace app_refresher.Controllers;

public class ProfileController : Controller
{
    private readonly IUserService _userService;

    public ProfileController(IUserService userService)
    {
        _userService = userService;
    }

    [HttpGet]
    public async Task<IActionResult> Index()
    {
        var userId = HttpContext.Session.GetInt32("UserId");
        if (userId is null)
        {
            return RedirectToAction("Login", "Auth", new { returnUrl = Url.Action("Index", "Profile") });
        }

        var user = await _userService.GetByIdAsync(userId.Value);
        if (user is null)
        {
            HttpContext.Session.Clear();
            return RedirectToAction("Login", "Auth");
        }

        return View(MapToViewModel(user));
    }

    [HttpPost]
    [ValidateAntiForgeryToken]
    public async Task<IActionResult> Index(ProfileViewModel model)
    {
        var userId = HttpContext.Session.GetInt32("UserId");
        if (userId is null)
        {
            return RedirectToAction("Login", "Auth", new { returnUrl = Url.Action("Index", "Profile") });
        }

        if (model.Id != userId.Value)
        {
            return RedirectToAction("Index");
        }

        if (!ModelState.IsValid)
        {
            var existingUser = await _userService.GetByIdAsync(userId.Value);
            model.EmploymentHistory = existingUser?.EmploymentHistory ?? new List<EmploymentHistoryItem>();
            model.Role = existingUser?.Role ?? string.Empty;
            return View(model);
        }

        var currentUser = await _userService.GetByIdAsync(userId.Value);
        if (currentUser is null)
        {
            HttpContext.Session.Clear();
            return RedirectToAction("Login", "Auth");
        }

        currentUser.Username = model.Username;
        currentUser.Email = model.Email;
        currentUser.FirstName = model.FirstName;
        currentUser.LastName = model.LastName;
        currentUser.Age = model.Age;
        currentUser.City = model.City;
        currentUser.Country = model.Country;
        currentUser.Phone = model.Phone;

        await _userService.UpdateAsync(currentUser);

        HttpContext.Session.SetString("DisplayName", model.FirstName);
        TempData["ProfileUpdated"] = "Profile details saved successfully.";
        return RedirectToAction(nameof(Index));
    }

    private static ProfileViewModel MapToViewModel(User user)
    {
        return new ProfileViewModel
        {
            Id = user.Id,
            Username = user.Username,
            Email = user.Email,
            FirstName = user.FirstName,
            LastName = user.LastName,
            Age = user.Age,
            City = user.City,
            Country = user.Country,
            Phone = user.Phone,
            Role = user.Role,
            EmploymentHistory = user.EmploymentHistory
        };
    }
}
