local TweenService = game:GetService("TweenService")
local ScreenGui = Instance.new("ScreenGui", game.CoreGui)

local MainFrame = Instance.new("Frame")
MainFrame.Size = UDim2.new(0, 0, 0, 0)
MainFrame.Position = UDim2.new(0.35, 0, 0.3, 0)
MainFrame.BackgroundColor3 = Color3.fromRGB(35, 35, 35)
MainFrame.BorderSizePixel = 0
MainFrame.Parent = ScreenGui
MainFrame.Active = true
MainFrame.Draggable = true
Instance.new("UICorner", MainFrame).CornerRadius = UDim.new(0, 12)

local titleLabel = Instance.new("TextLabel")
titleLabel.Size = UDim2.new(1, 0, 0, 30)
titleLabel.BackgroundTransparency = 1
titleLabel.Text = "Fling All"
titleLabel.Font = Enum.Font.GothamBold
titleLabel.TextColor3 = Color3.fromRGB(255, 255, 255)
titleLabel.TextScaled = true
titleLabel.Parent = MainFrame

local creditLabel = Instance.new("TextLabel")
creditLabel.Size = UDim2.new(1, 0, 0, 20)
creditLabel.Position = UDim2.new(0, 0, 0.2, 0)
creditLabel.BackgroundTransparency = 1
creditLabel.Text = "Script By SukaBintang01"
creditLabel.Font = Enum.Font.Gotham
creditLabel.TextColor3 = Color3.fromRGB(200, 200, 200)
creditLabel.TextScaled = true
creditLabel.Parent = MainFrame

local runButton = Instance.new("TextButton")
runButton.Size = UDim2.new(0.8, 0, 0.25, 0)
runButton.Position = UDim2.new(0.1, 0, 0.45, 0)
runButton.BackgroundColor3 = Color3.fromRGB(0, 170, 255)
runButton.Text = "Run Script"
runButton.Font = Enum.Font.GothamBold
runButton.TextColor3 = Color3.fromRGB(255, 255, 255)
runButton.TextScaled = true
runButton.Parent = MainFrame
Instance.new("UICorner", runButton).CornerRadius = UDim.new(0, 8)

local closeButton = Instance.new("TextButton")
closeButton.Size = UDim2.new(0.8, 0, 0.25, 0)
closeButton.Position = UDim2.new(0.1, 0, 0.75, 0)
closeButton.BackgroundColor3 = Color3.fromRGB(255, 60, 60)
closeButton.Text = "Close GUI"
closeButton.Font = Enum.Font.GothamBold
closeButton.TextColor3 = Color3.fromRGB(255, 255, 255)
closeButton.TextScaled = true
closeButton.Parent = MainFrame
Instance.new("UICorner", closeButton).CornerRadius = UDim.new(0, 8)

TweenService:Create(MainFrame, TweenInfo.new(0.5, Enum.EasingStyle.Back, Enum.EasingDirection.Out), {
    Size = UDim2.new(0, 250, 0, 180)
}):Play()

runButton.MouseButton1Click:Connect(function()
    loadstring(game:HttpGet("https://pastebin.com/raw/aZjZwuyd"))()
end)

closeButton.MouseButton1Click:Connect(function()
    ScreenGui:Destroy()
end)
