using System.ComponentModel.DataAnnotations;
using app_refresher.Models;

namespace app_refresher.ViewModels;

public class ProfileViewModel
{
    public int Id { get; set; }

    [Required]
    [StringLength(100)]
    public string Username { get; set; } = string.Empty;

    [Required]
    [EmailAddress]
    [StringLength(150)]
    public string Email { get; set; } = string.Empty;

    [Required]
    [StringLength(100)]
    public string FirstName { get; set; } = string.Empty;

    [Required]
    [StringLength(100)]
    public string LastName { get; set; } = string.Empty;

    [Range(16, 100)]
    public int Age { get; set; }

    [Required]
    [StringLength(100)]
    public string City { get; set; } = string.Empty;

    [Required]
    [StringLength(100)]
    public string Country { get; set; } = string.Empty;

    [Required]
    [Phone]
    [StringLength(30)]
    public string Phone { get; set; } = string.Empty;

    public string Role { get; set; } = string.Empty;
    public List<EmploymentHistoryItem> EmploymentHistory { get; set; } = new();
}
